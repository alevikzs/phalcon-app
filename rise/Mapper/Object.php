<?php

namespace Rise\Mapper;

use \stdClass,

    \Phalcon\Annotations\Collection as Annotations,
    \Phalcon\Annotations\Annotation,

    \Rise\Mapper,
    \Rise\Mapper\Exception\UnknownField as UnknownFieldException,
    \Rise\Mapper\Exception\NotObject as NotObjectException;

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
     * @throws NotObjectException
     * @throws UnknownFieldException
     */
    public function map() {
        $class = $this->getClass();
        $instance = new $class();

        $attributesAnnotations = $this
            ->getReflector()
            ->getPropertiesAnnotations();

        foreach ($this->getObject() as $attribute => $value) {
            $valueToSet = $value;

            $setter = 'set' . ucfirst($attribute);

            if (property_exists($class, $attribute) && method_exists($class, $setter)) {
                if (is_object($value) || is_array($value)) {
                    /** @var Annotations $attributeAnnotations */
                    $attributeAnnotations = $attributesAnnotations[$attribute];

                    if ($attributeAnnotations->has('Mapper')) {
                        /** @var Annotation $mapperAnnotation */
                        $mapperAnnotation = $attributeAnnotations->get('Mapper');
                        $mapperAnnotationClass = $mapperAnnotation->getArgument('class');

                        if (is_object($value)) {
                            /** @var stdClass $value */
                            $mapper = new self($value, $mapperAnnotationClass);
                            $valueToSet = $mapper->map();
                        } else {
                            $valueToSet = array_map(function(stdClass $val) use ($mapperAnnotationClass) {
                                return (new self($val, $mapperAnnotationClass))
                                    ->map();
                            }, $value);
                        }
                    } else {
                        throw new NotObjectException($attribute, $class);
                    }
                }

                $instance->$setter($valueToSet);
            } else {
                throw new UnknownFieldException($attribute, $class);
            }
        }

        return $instance;
    }

}