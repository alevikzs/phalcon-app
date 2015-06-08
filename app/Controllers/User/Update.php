<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple,

    \App\Models\User;

/**
 * Class Update
 * @package App\Controllers\User
 * @method int getId()
 */
class Update extends Simple {

    /**
     * @return Response
     */
    public function run() {
        User::findFirst($this->getId())
            ->save($this->getPayload());
        return $this->response();
    }

}