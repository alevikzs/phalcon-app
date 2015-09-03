<?php

namespace Rise\Mapper\Object;

use \stdClass,

    \Rise\Mapper\Object;

/**
 * Class Json
 * @package Rise\Mapper\Object
 */
class Json extends Object {

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

        parent::__construct(
            $this->toObject(),
            $class
        );
    }

    /**
     * @return stdClass
     */
    private function toObject() {
        return json_decode($this->getString());
    }

}