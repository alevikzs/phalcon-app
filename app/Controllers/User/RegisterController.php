<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \PhRest\Controller\Payload as PayloadController,

    \App\Models\User,
    \App\RequestPayload\User\Register as RequestPayload;

/**
 * Class RegisterController
 * @package App\Controllers\User
 * @method RequestPayload getPayload()
 * @payload(class="\App\RequestPayload\User\Register")
 */
class RegisterController extends PayloadController {

    /**
     * @return Response
     */
    public function runAction() {
        /** @var User $user */
        $user = (new User())
            ->setName($this->getPayload()->getName())
            ->setEmail($this->getPayload()->getEmail())
            ->setPassword($this->getPayload()->getPassword());

        $user->save();

        return $this->response([
            'user' => $user,
            'token' => $user->createToken()
        ]);
    }

}