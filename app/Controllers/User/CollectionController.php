<?php

namespace App\Controllers\User;

use \Phalcon\Mvc\Model\Criteria,
    \Phalcon\Http\Response,

    \Rise\Controller\Collection,

    \App\Models\User;

/**
 * Class CollectionController
 * @package App\Controllers\User
 * @payload(class="\Rise\RequestPayload\Collection")
 */
class CollectionController extends Collection {

    /**
     * @return Response
     */
    public function runAction() {
        /** @var Criteria $query */
        $query = User::query();
        return $this->response($query);
    }

}