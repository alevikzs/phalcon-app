<?php

namespace App\Controllers\User;

use \App\Components\Controller,
    \App\Models\User;

/**
 * Class Delete
 * @package App\Controllers\User
 * @method int getId()
 */
class Delete extends Controller {

    public function run() {
        User::findFirst($this->getId())
            ->delete();
        return $this->responseEmpty();
    }

}