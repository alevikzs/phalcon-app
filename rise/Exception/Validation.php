<?php

namespace Rise\Exception;

/**
 * Class User
 * @package Rise\Exception
 */
class Validation extends User {

    /**
     * @var array
     */
    public $errors;

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors) {
        $this->errors = $errors;
    }

    /**
     * @param array $errors
     * @param string $message
     * @param int $code
     */
    public function __construct(array $errors, $message = 'Validation error', $code = 400) {
        $this->setErrors($errors);

        parent::__construct($message, $code);
    }

}