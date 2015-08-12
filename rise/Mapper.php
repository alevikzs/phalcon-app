<?php

namespace Rise;

use \Phalcon\Annotations\Adapter\Memory as MemoryAdapter,
    \Phalcon\Annotations\Annotation;

/**
 * Class Mapper
 * @package Rise
 */
class Mapper {

    /**
     * @var string
     */
    private $json;

    /**
     * @var string
     */
    private $class;

    /**
     * @return string
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getJson() {
        return $this->json;
    }

    /**
     * @param string $json
     * @return $this
     */
    public function setJson($json) {
        $this->json = $json;
        return $this;
    }

    /**
     * @param string $json
     * @param string $class
     */
    public function __construct($json, $class) {
        $this
            ->setJson($json)
            ->setClass($class);
    }

    /**
     * @return mixed
     */
    public function map() {
        $reader = new MemoryAdapter();
        $reflector = $reader->get('\Rise\RequestPayload\Collection');

        $annotations = $reflector->getPropertiesAnnotations();

        /** @var Annotation $annotation */
        foreach ($annotations as $annotation) {
            print_r($annotation);

            if ($annotation->getName() === 'type') {
                $annotation->getArgument(0);
            }
        }
    }

}