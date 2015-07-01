<?php

namespace App\Controllers\Login;

use \Rise\Http\Response,
    \Rise\Controller\Simple,
    \Rise\RequestPayload\Login\Inner as Payload,
    \Rise\Exception\User as UserException,

    \App\Models\User;

/**
 * Class Inner
 * @package App\Controllers\Login
 */
class Inner extends Simple {

    /**
     * @return Payload
     */
    public function getPayload() {
        $rawPayload = $this->getRawPayload();

        return Payload::promote($rawPayload);
    }

    /**
     * @throws \Exception
     * @return Response
     */
    public function run() {
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