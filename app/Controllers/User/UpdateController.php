<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Payload as PayloadController,
    \Rise\Exception\User as UserException,

    \App\Models\User,
    \App\RequestPayload\User\Update as RequestPayload;

/**
 * Class UpdateController
 * @package App\Controllers\User
 * @method int getId()
 * @method RequestPayload getPayload()
 */
class UpdateController extends PayloadController {

    /**
     * @return string
     */
    protected function getRequestPayloadClass() {
        return '\App\RequestPayload\User\Update';
    }

    /**
     * @return Response
     * @throws UserException
     */
    public function runAction() {
        $user = User::findFirstById($this->getId());

        if ($user) {
            $name = $this->getPayload()->getName();
            if ($name) {
                $user->setName($name);
            }
            $email = $this->getPayload()->getEmail();
            if ($email) {
                $user->setEmail($email);
            }
            $password = $this->getPayload()->getPassword();
            if ($password) {
                $user->setPassword($password);
            }

            $user->save();

            return $this->response($user->toArray());
        } else {
            throw new UserException('User not found', 404);
        }
    }

}