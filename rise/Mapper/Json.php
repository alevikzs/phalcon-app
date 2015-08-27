<?php

namespace Rise\Mapper;

use \stdClass,

    \Rise\Mapper;

/**
 * Class Json
 * @package Rise\Mapper
 */
class Json extends Mapper {

    /**
     * @var string
     */
    private $string;

    /**
     * @return string
     */
    public function getString() {
        return $this->string;
    }

    /**
     * @param string $string
     * @return $this
     */
    public function setString($string) {
        $this->string = $string;

        return $this;
    }

    /**
     * @param string $string
     * @param string $class
     */
    public function __construct($string, $class) {
        $this->setString($string);

        parent::__construct($class);
    }

    /**
     * @return stdClass
     */
    public function map() {

    }

}