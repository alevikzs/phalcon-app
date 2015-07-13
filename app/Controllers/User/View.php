<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple as SimpleController,
    \Rise\Exception\User as UserException,

    \App\Models\User;

/**
 * Class View
 * @package App\Controllers\User
 * @method int getId()
 */
class View extends SimpleController {

    /**
     * @return Response
     * @throws UserException
     */
    public function run() {
        /** @var User $user */
        $user = User::findFirstById($this->getId());

        if ($user) {
            return $this->response($user->toArray());
        } else {
            throw new UserException('User not found', 404);
        }
    }

}