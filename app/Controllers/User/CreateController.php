<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Payload as PayloadController,

    \App\Models\User,
    \App\RequestPayload\User\Create as RequestPayload;

/**
 * Class CreateController
 * @package App\Controllers\User
 * @method RequestPayload getPayload()
 * @payload(class="\App\RequestPayload\User\Create")
 */
class CreateController extends PayloadController {

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

        return $this->response($user);
    }

}