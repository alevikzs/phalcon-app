<?php

namespace App\Controllers\User;

use \App\Components\Controller\Base,
    \App\Models\User;

/**
 * Class Delete
 * @package App\Controllers\User
 * @method int getId()
 */
class Delete extends Base {

    public function run() {
        User::findFirst($this->getId())
            ->delete();
        return $this->responseEmpty();
    }

}