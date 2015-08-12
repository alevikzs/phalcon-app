<?php

namespace Rise;

use \Phalcon\Annotations\Adapter\Memory as MemoryAdapter,
    \Phalcon\Annotations\Annotation,
    \Phalcon\Annotations\Collection as AnnotationCollection,
    \Phalcon\Annotations\Reflection;

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
     * @var Reflection
     */
    private $reflector;

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
     * @return Reflection
     */
    protected function getReflector() {
        return $this->reflector;
    }

    /**
     * @param Reflection $reflector
     * @return $this
     */
    protected function setReflector(Reflection $reflector) {
        $this->reflector = $reflector;

        return $this;
    }

    /**
     * @param string $json
     * @param string $class
     */
    public function __construct($json, $class) {
        $this
            ->setJson($json)
            ->setClass($class)
            ->setReflector(
                (new MemoryAdapter())
                    ->get($class)
            );
    }

    /**
     * @return mixed
     */
    public function map() {
        $attributes = $this
            ->getReflector()
            ->getPropertiesAnnotations();

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