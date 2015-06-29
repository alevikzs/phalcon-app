<?php

namespace Rise\RequestPayload\Token;

use Rise\RequestPayload;

/**
 * Class Facebook
 * @package Rise\RequestPayload\Token
 */
class Facebook extends RequestPayload {

    /**
     * @var string
     */
    public $token;

    /**
     * @return string
     */
    public function getToken() {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    /**
     * @param string $token
     */
    public function __construct($token = null) {
        $this->setToken($token);
    }

}