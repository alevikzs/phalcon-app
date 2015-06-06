<?php

namespace App\Controllers\User;

use \App\Rise\Controller\Simple,
    \App\Models\User;

/**
 * Class Update
 * @package App\Controllers\User
 * @method int getId()
 */
class Update extends Simple {

    /**
     * @return \Phalcon\Http\Response
     */
    public function run() {
        User::findFirst($this->getId())
            ->save($this->getPayload());
        return $this->response();
    }

}