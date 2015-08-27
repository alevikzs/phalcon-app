<?php

namespace Rise\Mapper;

use \stdClass,

    \Rise\Mapper;

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
     * @return stdClass
     */
    public function map() {

    }

}