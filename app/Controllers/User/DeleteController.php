<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple as SimpleController,
    \Rise\Exception\User as UserException,

    \App\Models\User;

/**
 * Class DeleteController
 * @package App\Controllers\User
 * @method int getId()
 */
class DeleteController extends SimpleController {

    /**
     * @return Response
     * @throws UserException
     */
    public function runAction() {
        $user = User::findFirstById($this->getId());

        if ($user) {
            $user->delete();

            return $this->response($user);
        } else {
            throw new UserException('User not found', 404);
        }
    }

}