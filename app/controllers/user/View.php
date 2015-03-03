<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

/**
 * @method int getId()
 */
class View extends Controller {

    public function run() {
        $user = User::findFirst(['id' => $this->getId()])
            ->toArray();
        return $this->response($user);
    }

}