<?php

namespace Rise\Mapper;

use \stdClass,

    \Rise\Mapper;

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
     */
    public function map() {
        $class = $this->getClass();
        $instance = new $class;

        foreach ($this->getObject() as $attribute => $value) {
            if (is_object($value) || is_array($value)) {
                $attributeAnotations = $this
                    ->getReflector()
                    ->getPropertiesAnnotations()
                    ->get($attribute)
                    ->getArgument('class');

                if (is_object($value)) {
                    $compositeClass = '';
                    $mapper = new self($value, $compositeClass);
                    $value = $mapper->map();
                } else {
                    foreach ($value as $composite) {

                    }
                }

            }

            $setter = 'set' . ucfirst($attribute);
            $instance->$setter($value);
        }

        $attributes = $this
            ->getReflector()
            ->getPropertiesAnnotations()
            ->get('');
        /** @var AnnotationCollection $annotations */
        foreach ($attributes as $attribute => $annotations) {
            if ($annotations->has('Mapper')) {
                /** @var Annotation $annotation */
                $annotation = $annotations->get('Mapper');
                $annotation->getArgument('class');
                print_r($annotation);
            }

        }
    }

}