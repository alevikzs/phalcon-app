<?php

namespace App\RequestPayload\User;

use \Phalcon\Validation,
    \Phalcon\Validation\Validator\Email,
    \Phalcon\Validation\Validator\PresenceOf,

    \Rise\RequestPayload;

/**
 * Class Update
 * @package App\RequestPayload\User
 */
class Update extends RequestPayload {

    /**
     * @var string
     */
    public $name;

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
     * @param Validation $validator
     * @return Validation
     */
    protected function validation(Validation $validator) {
        if ($this->getEmail()) {
            $validator
                ->add('email', new Email([
                    'message' => 'The e-mail is not valid'
                ]));
        }
        return $validator;
    }

}