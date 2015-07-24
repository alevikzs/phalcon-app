<?php

namespace Rise\RequestPayload\Login;

use \Phalcon\Validation,
    \Phalcon\Validation\Validator\Email,
    \Phalcon\Validation\Validator\PresenceOf,

    \Rise\RequestPayload;

/**
 * Class Inner
 * @package Rise\RequestPayload\Login
 */
class Inner extends RequestPayload {

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

    /**
     * @param Validation $validator
     * @return Validation
     */
    protected function validation(Validation $validator) {
        return $validator
            ->add('email', new PresenceOf([
                'message' => 'The e-mail is required'
            ]))
            ->add('email', new Email([
                'message' => 'The e-mail is not valid'
            ]));
    }

}