<?php

namespace Rise\Auth;

use \JWT,

    \Phalcon\Security;

/**
 * Class Session
 * @package Rise\Auth
 */
class Session {

    /**
     * @var string
     */
    private $algorithm;

    /**
     * @var string
     */
    private $salt;

    /**
     * @return string
     */
    public function getAlgorithm() {
        return $this->algorithm;
    }

    /**
     * @param string $algorithm
     * @return $this
     */
    public function setAlgorithm($algorithm) {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @param string $salt
     * @return $this
     */
    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @param string $algorithm
     * @param string $salt
     */
    public function __construct($algorithm = 'HS256' , $salt = null) {
        $this
            ->setAlgorithm($algorithm)
            ->setSalt($salt);
    }

    /**
     * @param array $token
     * @return string
     */
    public function encode(array $token) {
        return JWT::encode($token, $this->getSalt());
    }

    /**
     * @param string $token
     * @return array
     */
    public function decode($token) {
        return JWT::decode($token, $this->getSalt(), [$this->getAlgorithm()]);
    }

    /**
     * @param array $user
     * @param integer $expiration
     * @return array
     */
    public static function create($user, $expiration) {
        $iat = time();

        return [
            'sub' => $user,
            'iat' => $iat,
            'exp' => $iat + $expiration
        ];
    }

}