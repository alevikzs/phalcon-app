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

        $attributesAnnotations = $this
            ->getReflector()
            ->getPropertiesAnnotations();

        foreach ($this->getObject() as $attribute => $value) {
            $setter = $this->createSetter($attribute);

            if ($this->hasAttribute($attribute)) {
                /** @var Annotations $attributeAnnotations */
                $attributeAnnotations = $attributesAnnotations[$attribute];

                $valueToMap = $this->buildValueToMap($attribute, $value, $attributeAnnotations);

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

        return property_exists($this->getClass(), $attribute)
            && method_exists($this->getClass(), $setter);
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param Annotations $attributeAnnotations
     * @return mixed
     * @throws MustBeSimpleException
     * @throws MustBeArrayException
     * @throws MustBeObjectException
     */
    private function buildValueToMap($attribute, $value, Annotations $attributeAnnotations) {
        $valueToMap = $value;

        if ($attributeAnnotations->has('mapper')) {
            /** @var Annotation $mapperAnnotation */
            $mapperAnnotation = $attributeAnnotations->get('mapper');
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

}