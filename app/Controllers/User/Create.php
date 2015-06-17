<?php

namespace App\Controllers\User;

use \Phalcon\Http\Response,

    \Rise\Controller\Simple,

    \App\Models\User;

/**
 * Class Create
 * @package App\Controllers\User
 */
class Create extends Simple {

    /**
     * @return Response
     */
    public function run() {
        (new User())
            ->save($this->getRawPayload(true));
        return $this->response();
    }

}