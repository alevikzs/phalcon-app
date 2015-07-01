<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple,
    \Rise\Exception\User as UserException,

    \App\Models\User;

/**
 * Class View
 * @package App\Controllers\User
 * @method int getId()
 */
class View extends Simple {

    /**
     * @return Response
     * @throws UserException
     */
    public function run() {
        $user = User::findFirstById($this->getId());

        if ($user) {
            return $this->response($user);
        } else {
            throw new UserException('User not found', 404);
        }
    }

}