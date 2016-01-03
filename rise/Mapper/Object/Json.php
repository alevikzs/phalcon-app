<?php

namespace Rise\Mapper\Object;

use \stdClass,

    \Rise\Exception\User as UserException,
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
     * @throws UserException
     */
    private function toObject() {
        $object = json_decode($this->getString());

        if (is_null($object)) {
            throw new UserException('Invalid json');
        }

        return $object;
    }

}