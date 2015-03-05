<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

/**
 * @method int getId()
 */
class Update extends Controller {

    public function run() {
        User::findFirst($this->getId())
            ->save($this->getPayload());
        return $this->response();
    }

}