<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple as SimpleController,
    \Rise\Exception\User as UserException,

    \App\Models\User;

/**
 * Class Delete
 * @package App\Controllers\User
 * @method int getId()
 */
class Delete extends SimpleController {

    /**
     * @return Response
     * @throws UserException
     */
    public function run() {
        $user = User::findFirstById($this->getId());

        if ($user) {
            $user->delete();

            return $this->response($user->toArray());
        } else {
            throw new UserException('User not found', 404);
        }
    }

}