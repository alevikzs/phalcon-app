<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple as SimpleController,

    \App\Models\User;

/**
 * Class CreateController
 * @package App\Controllers\User
 */
class CreateController extends SimpleController {

    /**
     * @return Response
     */
    public function runAction() {
        /** @var User $user */
        $user = (new User())->assign($this->getRawPayload());
        $user->save();

        return $this->response($user->toArray());
    }

}