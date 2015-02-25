<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User as UserModel;

class Collection extends Controller {

    public function run() {
        $users = UserModel::find()->toArray();
        return $this->response($users);
    }

}