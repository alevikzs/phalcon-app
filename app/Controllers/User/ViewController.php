<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple as SimpleController,
    \Rise\Exception\User as UserException,

    \App\Models\User;

/**
 * Class ViewController
 * @package App\Controllers\User
 * @method int getId()
 */
class ViewController extends SimpleController {

    /**
     * @return Response
     * @throws UserException
     */
    public function runAction() {
        /** @var User $user */
        $user = User::findFirstById($this->getId());

        if ($user) {
            return $this->response($user);
        } else {
            throw new UserException('User not found', 404);
        }
    }

}