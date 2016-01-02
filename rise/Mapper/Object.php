<?php

namespace Rise\Mapper;

use \stdClass,

    \Phalcon\Annotations\Collection as Annotations,
    \Phalcon\Annotations\Annotation,

    \Rise\Mapper,
    \Rise\Mapper\Exception\UnknownField as UnknownFieldException,
    \Rise\Mapper\Exception\MustBeSimple as MustBeSimpleException,
    \Rise\Mapper\Exception\MustBeArray as MustBeArrayException,
    \Rise\Mapper\Exception\MustBeObject as MustBeObjectException;

/**
 * Class Object
 * @package Rise\Mapper
 */
class Object extends Mapper {

    /**
     * @var stdClass
     */
    private $object;

    /**
     * @return stdClass
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param stdClass $object
     * @return $this
     */
    public function setObject(stdClass $object) {
        $this->object = $object;

        return $this;
    }

    /**
     * @param stdClass $object
     * @param string $class
     */
    public function __construct(stdClass $object, $class) {
        $this->setObject($object);

        parent::__construct($class);
    }

    /**
     * @return stdClass
     * @throws UnknownFieldException
     */
    public function map() {
        $class = $this->getClass();
        $instance = new $class();

        $methodsAnnotations = $this
            ->getReflector()
            ->getMethodsAnnotations();

        foreach ($this->getObject() as $attribute => $value) {
            $setter = $this->createSetter($attribute);

            if ($this->hasAttribute($attribute)) {
                /** @var Annotations $methodAnnotations */
                $methodAnnotations = $methodsAnnotations[$setter];

                $valueToMap = $this->buildValueToMap($attribute, $value, $methodAnnotations);

                $instance->$setter($valueToMap);
            } else {
                throw new UnknownFieldException($attribute, $class);
            }
        }

        return $instance;
    }

    /**
     * @param string $attribute
     * @return boolean
     */
    private function hasAttribute($attribute) {
        $setter = $this->createSetter($attribute);
        $getter = $this->createGetter($attribute);

        return method_exists($this->getClass(), $getter)
            && method_exists($this->getClass(), $setter);
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param Annotations $methodAnnotations
     * @return mixed
     * @throws MustBeSimpleException
     * @throws MustBeArrayException
     * @throws MustBeObjectException
     */
    private function buildValueToMap($attribute, $value, Annotations $methodAnnotations) {
        $valueToMap = $value;

        if ($methodAnnotations->has('mapper')) {
            /** @var Annotation $mapperAnnotation */
            $mapperAnnotation = $methodAnnotations->get('mapper');
            $mapperAnnotationClass = $mapperAnnotation->getArgument('class');
            $mapperAnnotationIsArray = $mapperAnnotation->getArgument('isArray');

            if ($this->isObject($value)) {
                if ($mapperAnnotationIsArray) {
                    throw new MustBeArrayException($attribute, $this->getClass());
                } else {
                    /** @var stdClass $value */
                    $mapper = new self($value, $mapperAnnotationClass);
                    $valueToMap = $mapper->map();
                }
            } else {
                if ($mapperAnnotationIsArray) {
                    $valueToMap = array_map(function(stdClass $val) use ($mapperAnnotationClass) {
                        return (new self($val, $mapperAnnotationClass))
                            ->map();
                    }, $value);
                } else {
                    throw new MustBeObjectException($attribute, $this->getClass());
                }
            }
        } elseif ($this->isComposite($value)) {
            throw new MustBeSimpleException($attribute, $this->getClass());
        }

        return $valueToMap;
    }

    /**
     * @param mixed $value
     * @return boolean
     */
    private function isObject($value) {
        return is_object($value);
    }

    /**
     * @param mixed $value
     * @return boolean
     */
    private function isArray($value) {
        return is_array($value);
    }

    /**
     * @param mixed $value
     * @return boolean
     */
    private function isComposite($value) {
        return $this->isObject($value) || $this->isArray($value);
    }

    /**
     * @param string $attribute
     * @return string
     */
    private function createSetter($attribute) {
        return 'set' . ucfirst($attribute);
    }

    /**
     * @param string $attribute
     * @return string
     */
    private function createGetter($attribute) {
        return 'get' . ucfirst($attribute);
    }

}