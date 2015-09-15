<?php

namespace App\Controllers\Login;

use \Rise\Http\Response,
    \Rise\Controller\Payload as PayloadController,
    \Rise\Exception\User as UserException,
    \Rise\RequestPayload\Login\Inner as LoginRequestPayload,

    \App\Models\User;

/**
 * Class InnerController
 * @package App\Controllers\Login
 * @method LoginRequestPayload getPayload()
 * @payload(class="\Rise\RequestPayload\Login\Inner")
 */
class InnerController extends PayloadController {

    /**
     * @throws UserException
     * @return Response
     */
    public function runAction() {
        $user = User::findFirstByEmail($this->getPayload()->getEmail());

        if ($user) {
            if ($this->security->checkHash(
                $this->getPayload()->getPassword(),
                $user->getPassword())
            ) {
                return $this->response([
                    'user' => $user->toArray(),
                    'token' => $user->createToken()
                ]);
            } else {
                throw new UserException('Wrong password', 400);
            }
        } else {
            throw new UserException('User not found', 404);
        }
    }

}