<?php

namespace Rise\Mapper\Exception;

use Rise\Mapper\Exception;

/**
 * Class MustBeObject
 * @package Rise\Mapper\Exception
 */
class MustBeObject extends Exception {

    /**
     * @param string $field
     * @param string $class
     */
    public function __construct($field, $class) {
        $this
            ->setField($field)
            ->setClass($class);

        $message = "$field field of $class class must be an object";

        parent::__construct($message);
    }

}