<?php

namespace App\RequestPayload\User;

use \Phalcon\Validation,
    \Phalcon\Validation\Validator\Email,

    \App\RequestPayload\User;

/**
 * Class Update
 * @package App\RequestPayload\User
 */
class Update extends User {

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