<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

class Create extends Controller {

    public function run() {
        (new User())
            ->save($this->getPayload());
        return $this->response();
    }

}