<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple as SimpleController,
    \Rise\Exception\User as UserException,

    \App\Models\User;

/**
 * Class Update
 * @package App\Controllers\User
 * @method int getId()
 */
class Update extends SimpleController {

    /**
     * @return Response
     * @throws UserException
     */
    public function run() {
        $user = User::findFirstById($this->getId());

        if ($user) {
            $user->save($this->getRawPayload());

            return $this->response($user->toArray());
        } else {
            throw new UserException('User not found', 404);
        }
    }

}