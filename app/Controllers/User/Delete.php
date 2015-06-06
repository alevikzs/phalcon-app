<?php

namespace App\Controllers\User;

use \Rise\Controller\Simple,
    \App\Models\User;

/**
 * Class Delete
 * @package App\Controllers\User
 * @method int getId()
 */
class Delete extends Simple {

    /**
     * @return \Phalcon\Http\Response
     */
    public function run() {
        User::findFirst($this->getId())
            ->delete();
        return $this->response();
    }

}