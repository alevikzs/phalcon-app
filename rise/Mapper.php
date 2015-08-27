<?php

namespace Rise;

use \stdClass,

    \Phalcon\Annotations\Adapter\Memory as MemoryAdapter,
    \Phalcon\Annotations\Reflection;

/**
 * Class Mapper
 * @package Rise
 */
abstract class Mapper {

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
     * @param string $class
     */
    public function __construct($class) {
        $this
            ->setClass($class)
            ->setReflector(
                (new MemoryAdapter())
                    ->get($class)
            );
    }

    /**
     * @return stdClass
     */
    abstract public function map();

}