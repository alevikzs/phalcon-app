<?php

namespace App\Controllers\User;

use \Phalcon\Mvc\Model\Resultset\Simple as Query,

    \App\Components\Controller\Collection as CollectionController,
    \App\Models\User;

/**
 * Class Collection
 * @package App\Controllers\User
 */
class Collection extends CollectionController {

    public function run() {
        /** @var Query $users */
        $users = User::find();
        return $this->response($users);
    }

}