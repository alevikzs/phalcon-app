<?php

namespace Rise\Mapper;

use \stdClass,

    \Phalcon\Annotations\Collection as Annotations,
    \Phalcon\Annotations\Annotation,

    \Rise\Exception\Validation as ValidationException,
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
        $instance = new $class();

        $attributesAnnotations = $this
            ->getReflector()
            ->getPropertiesAnnotations();

        foreach ($this->getObject() as $attribute => $value) {
            $valueToSet = $value;

            if (is_object($value) || is_array($value)) {
                if (isset($attributesAnnotations[$attribute])) {
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
                        // Mapper is missing in class definition
                    }
                } else {
                    // json attribute is missing in attributes list of object
                }
            }

            $setter = 'set' . ucfirst($attribute);
            if (property_exists($class, $attribute) && method_exists($class, $setter)) {
                $instance->$setter($valueToSet);
            } else {

            }

        }

        return $instance;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @throws ValidationException
     */
    public function __call($name, array $arguments) {
        $field = lcfirst(substr($name, 3));

        $message = [
            'field' => $field,
            'message' => 'Unknown field',
            'type' => 'Unknown'
        ];

        throw new ValidationException([$message]);
    }

}