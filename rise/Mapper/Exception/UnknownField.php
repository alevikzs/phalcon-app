<?php

namespace Rise\Mapper\Exception;

use Rise\Mapper\Exception;

/**
 * Class UnknownField
 * @package Rise\Mapper\Exception
 */
class UnknownField extends Exception {

    /**
     * @param string $field
     * @param string $class
     */
    public function __construct($field, $class) {
        $this
            ->setField($field)
            ->setClass($class);

        $message = "$class hasn't $field field";

        parent::__construct($message);
    }

}