<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple,

    \App\Models\User;

/**
 * Class View
 * @package App\Controllers\User
 * @method int getId()
 */
class View extends Simple {

    /**
     * @return Response
     */
    public function run() {
        $user = User::findFirst($this->getId())
            ->toArray();
        return $this->response($user);
    }

}