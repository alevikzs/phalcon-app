<?php

namespace App\Controllers\User;

use \Phalcon\Mvc\Model\Criteria,
    \Phalcon\Http\Response,

    \PhRest\Controller\Collection,

    \App\Models\User;

/**
 * Class CollectionController
 * @package App\Controllers\User
 * @payload(class="\PhRest\RequestPayload\Collection")
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