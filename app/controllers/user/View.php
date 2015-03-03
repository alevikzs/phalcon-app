<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

class View extends Controller {

    public function run() {
        $params = $this->router->getParams();
        $user = User::findFirst(['id' => $params['id']])->toArray();
        return $this->response($user);
    }

}