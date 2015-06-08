<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple,

    \App\Models\User;

/**
 * Class Delete
 * @package App\Controllers\User
 * @method int getId()
 */
class Delete extends Simple {

    /**
     * @return Response
     */
    public function run() {
        User::findFirst($this->getId())
            ->delete();
        return $this->response();
    }

}