<?php

namespace App\Controllers\User;

use \App\Components\Controller\Simple,
    \App\Models\User;

/**
 * Class View
 * @package App\Controllers\User
 * @method int getId()
 */
class View extends Simple {

    /**
     * @return \Phalcon\Http\Response
     */
    public function run() {
        $user = User::findFirst($this->getId())
            ->toArray();
        return $this->response($user);
    }

}