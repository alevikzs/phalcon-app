<?php

namespace Rise\Models\Request\Token;

/**
 * Class Facebook
 * @package Rise\Models\Request\Token
 */
class Facebook {

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