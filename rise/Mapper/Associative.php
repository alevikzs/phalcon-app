<?php

namespace Rise\Mapper;

use \Phalcon\Annotations\Collection as Annotations,
    \Phalcon\Annotations\Annotation,

    \Rise\Mapper,
    \Rise\Mapper\Exception\UnknownField as UnknownFieldException,
    \Rise\Mapper\Exception\NotObject as NotObjectException;

/**
 * Class Associative
 * @package Rise\Mapper
 */
class Associative extends Mapper {

    /**
     * @var array
     */
    private $array;

    /**
     * @return array
     */
    public function getArray() {
        return $this->array;
    }

    /**
     * @param array $array
     * @return $this
     */
    public function setArray(array $array) {
        $this->array = $array;

        return $this;
    }

    /**
     * @param array $array
     * @param string $class
     */
    public function __construct(array $array, $class) {
        $this->setArray($array);

        parent::__construct($class);
    }

    /**
     * @return mixed
     * @throws NotObjectException
     * @throws UnknownFieldException
     */
    public function map() {
        $class = $this->getClass();
        $instance = new $class();

        $attributesAnnotations = $this
            ->getReflector()
            ->getPropertiesAnnotations();

        foreach ($this->getArray() as $attribute => $value) {
            $valueToSet = $value;

            $setter = 'set' . ucfirst($attribute);

            if (property_exists($class, $attribute) && method_exists($class, $setter)) {
                if ($this->isArray($value) && ($this->hasStringKeys($value) || $this->hasIntegerKeys($value))) {
                    /** @var Annotations $attributeAnnotations */
                    $attributeAnnotations = $attributesAnnotations[$attribute];

                    if ($attributeAnnotations->has('Mapper')) {
                        /** @var Annotation $mapperAnnotation */
                        $mapperAnnotation = $attributeAnnotations->get('Mapper');
                        $mapperAnnotationClass = $mapperAnnotation->getArgument('class');

                        if ($this->hasStringKeys($value)) {
                            /** @var array $value */
                            $mapper = new self($value, $mapperAnnotationClass);
                            $valueToSet = $mapper->map();
                        } else {
                            $valueToSet = array_map(function(array $val) use ($mapperAnnotationClass) {
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

    /**
     * @param array $array
     * @return bool
     */
    private function hasStringKeys(array $array) {
        foreach($array as $key => $item) {
            if (is_integer($key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $array
     * @return bool
     */
    private function hasIntegerKeys(array $array) {
        foreach($array as $key => $item) {
            if (is_string($key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    private function isArray($value) {
        return is_array($value);
    }

}