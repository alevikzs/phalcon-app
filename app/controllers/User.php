<?php

namespace App\Controllers;

use \App\Components\Controller,
    \App\Models\User as UserModel;

class User extends Controller {

    public function create() {
        echo 'user create';
    }

    public function update() {
        echo 'user update';
    }

    public function delete() {
        echo 'user delete';
    }

    public function index() {
        $users = UserModel::find()->toArray();
        return $this->response($users);
    }

}