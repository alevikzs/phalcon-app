<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

/**
 * Class Delete
 * @package App\Controllers\User
 * @method int getId()
 */
class View extends Controller {

    public function run() {
        $user = User::findFirst($this->getId())
            ->toArray();
        return $this->response($user);
    }

}