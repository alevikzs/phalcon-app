<?php

namespace App\RequestPayload\User;

use \Phalcon\Validation,
    \Phalcon\Validation\Validator\Email,
    \Phalcon\Validation\Validator\PresenceOf,

    \App\RequestPayload\User;

/**
 * Class Register
 * @package App\RequestPayload
 */
class Register extends User {

    /**
     * @param Validation $validator
     * @return Validation
     */
    protected function validation(Validation $validator) {
        return $validator
            ->add('name', new PresenceOf([
                'message' => 'The name is required'
            ]))
            ->add('password', new PresenceOf([
                'message' => 'The password is required'
            ]))
            ->add('email', new PresenceOf([
                'message' => 'The e-mail is required'
            ]))
            ->add('email', new Email([
                'message' => 'The e-mail is not valid'
            ]));
    }

}