<?php

namespace App\Controllers\User;

use \Rise\Controller\Simple,
    \App\Models\User;

/**
 * Class Create
 * @package App\Controllers\User
 */
class Create extends Simple {

    /**
     * @return \Phalcon\Http\Response
     */
    public function run() {
        (new User())
            ->save($this->getPayload());
        return $this->response();
    }

}