<?php

namespace App\Components\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Model\Resultset\Simple;

/**
 * Class ListController
 * @package App\Components
 * @method int getLimit()
 * @method int getPage()
 */
abstract class Collection extends Base {

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