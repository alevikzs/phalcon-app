<?php

namespace App\RequestPayload;

use \PhRest\RequestPayload;

/**
 * Class User
 * @package App\RequestPayload
 */
abstract class User extends RequestPayload {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

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
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct($name = null, $email = null, $password = null) {
        $this
            ->setEmail($name)
            ->setEmail($email)
            ->setPassword($password);
    }

    /**
     * @return array
     */
    public function getPublicProperties() {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ];
    }

}