<?php

namespace App\Controllers\Token;

use \Rise\Http\Response,
    \Rise\Controller\Simple,
    \Rise\RequestPayload\Token\Inner as Payload,
    \Rise\Auth\Session,
    \Rise\Exception\User as UserException,

    \App\Models\User;

/**
 * Class Inner
 * @package App\Controllers\Token
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
                $token = (new Session())->encode([
                    'id' => $user->getId()
                ]);

                return $this->response([
                    'user' => $user->toArray(),
                    'token' => $token
                ]);
            } else {
                throw new UserException('Wrong password', 400);
            }
        } else {
            throw new UserException('User not found', 404);
        }
    }

}