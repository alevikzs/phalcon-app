<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

class Delete extends Controller {

    public function run() {
        $params = $this->router->getParams();
        User::findFirst(['id' => $params['id']])
            ->delete();
        return $this->response();
    }

}