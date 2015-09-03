<?php

namespace Rise\Mapper\Exception;

use Rise\Mapper\Exception;

/**
 * Class MustBeArray
 * @package Rise\Mapper\Exception
 */
class MustBeArray extends Exception {

    /**
     * @param string $field
     * @param string $class
     */
    public function __construct($field, $class) {
        $this
            ->setField($field)
            ->setClass($class);

        $message = "$field field of $class class must be an array";

        parent::__construct($message);
    }

}