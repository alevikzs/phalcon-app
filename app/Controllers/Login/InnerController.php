<?php

namespace App\Controllers\Login;

use \PhRest\Http\Response,
    \PhRest\Controller\Payload as PayloadController,
    \PhRest\Exception\User as UserException,
    \PhRest\RequestPayload\Login\Inner as LoginRequestPayload,

    \App\Models\User;

/**
 * Class InnerController
 * @package App\Controllers\Login
 * @method LoginRequestPayload getPayload()
 * @payload(class="\PhRest\RequestPayload\Login\Inner")
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
                    'user' => $user,
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