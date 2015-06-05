<?php

namespace App\Controllers\User;

use \Phalcon\Mvc\Model\Criteria,
    \Phalcon\Http\Response,

    \App\Components\Controller\Collection as CollectionController,
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
        $var = null;
        $var->df;
        /** @var Criteria $query */
        $query = User::query();
        return $this->response($query);
    }

}