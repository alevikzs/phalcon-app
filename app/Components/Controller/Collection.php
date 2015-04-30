<?php

namespace App\Components\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Model\Resultset\Simple;

/**
 * Class Collection
 * @package App\Components\Controller
 * @method int getLimit()
 * @method int getPage()
 */
abstract class Collection extends Base {

    /**
     * @return int
     */
    public function getOffset() {
        return $this->getLimit() * ($this->getPage() - 1);
    }

    /**
     * @param Simple $query
     * @return Response
     */
    public function response(Simple $query) {
        return $this->responseEmpty()
            ->setJsonContent([
                'list' => $query->toArray(),
                'count' => $query->count()
            ]);
    }

}