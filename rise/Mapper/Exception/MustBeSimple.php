<?php

namespace Rise\Mapper\Exception;

use Rise\Mapper\Exception;

/**
 * Class MustBeSimple
 * @package Rise\Mapper\Exception
 */
class MustBeSimple extends Exception {

    /**
     * @param string $field
     * @param string $class
     */
    public function __construct($field, $class) {
        $this
            ->setField($field)
            ->setClass($class);

        $message = "$field field of $class class must be a simple type";

        parent::__construct($message);
    }

}