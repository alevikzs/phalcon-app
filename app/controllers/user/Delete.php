<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

/**
 * @method int getId()
 */
class Delete extends Controller {

    public function run() {
        User::findFirst(['id' => $this->getId()])
            ->delete();
        return $this->response();
    }

}