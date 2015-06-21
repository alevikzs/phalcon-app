<?php

namespace Rise\Models\Request\Token;

use \Rise\JsonSerialization;

/**
 * Class Inner
 * @package Rise\Models\Request\Token
 */
class Inner {

    use JsonSerialization;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $email
     * @param string $password
     */
    public function __construct($email = null, $password = null) {
        $this
            ->setEmail($email)
            ->setPassword($password);
    }

}