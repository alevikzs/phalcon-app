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
 * @payload(class="\App\RequestPayload\User\Update")
 */
class UpdateController extends PayloadController {

    /**
     * @return Response
     * @throws UserException
     */
    public function runAction() {
        $user = User::findFirstById($this->getId());

        if ($user) {
            $name = $this->getPayload()->getName();
            if (!is_null($name)) {
                $user->setName($name);
            }
            $email = $this->getPayload()->getEmail();
            if (!is_null($email)) {
                $user->setEmail($email);
            }
            $password = $this->getPayload()->getPassword();
            if (!is_null($password)) {
                $user->setPassword($password);
            }

            $user->save();

            return $this->response($user);
        } else {
            throw new UserException('User not found', 404);
        }
    }

}