<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

class Collection extends Controller {

    public function run() {
        $users = User::find()->toArray();
        return $this->response($users);
    }

}