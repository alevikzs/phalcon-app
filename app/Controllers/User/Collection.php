<?php

namespace App\Controllers\User;

use \Phalcon\Mvc\Model\Criteria,
    \Phalcon\Http\Response,

    \Rise\Controller\Collection as CollectionController,

    \App\Models\User;

/**
 * Class Collection
 * @package App\Controllers\User
 */
class Collection extends CollectionController {

    /**
     * @return Response
     */
    public function run() {
        /** @var Criteria $query */
        $query = User::query();
        return $this->response($query);
    }

}