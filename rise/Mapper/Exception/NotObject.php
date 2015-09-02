<?php

namespace Rise\Mapper\Exception;

use Rise\Mapper\Exception;

/**
 * Class NotObject
 * @package Rise\Mapper\Exception
 */
class NotObject extends Exception {

    /**
     * @param string $field
     * @param string $class
     */
    public function __construct($field, $class) {
        $this
            ->setField($field)
            ->setClass($class);

        $message = "$field field of $class class has a simple type";

        parent::__construct($message);
    }

}