<?php

namespace App\Controllers\Token;

use \Rise\Http\Response,
    \Rise\Controller\Simple,
    \Rise\Models\Request\Token\Inner as Payload,
    \Rise\Auth\Session,

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
     * @throws \HttpException
     * @return Response
     */
    public function run() {
        $user = User::query()->where([
            'email' => $this->getPayload()->getEmail(),
            'password' => $this->getPayload()->getPassword()
        ]);
        if ($user) {
            $session = new Session();
        } else {
            throw new \HttpException('User not found', 404);
        }
        return $this->response($user);
    }

}