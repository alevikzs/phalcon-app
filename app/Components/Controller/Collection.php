<?php

namespace App\Components\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Model\Criteria;

/**
 * Class Collection
 * @package App\Components\Controller
 * @method int getLimit()
 * @method int getPage()
 */
abstract class Collection extends Base {

    /**
     * @return integer
     */
    public function getOffset() {
        return $this->getLimit() * ($this->getPage() - 1);
    }

    /**
     * @return array
     */
    protected function defaultParameters() {
        return [
            'page' => 1,
            'limit' => 20
        ];
    }

    /**
     * @param Criteria $query
     * @return Response
     */
    public function response(Criteria $query) {
        return $this->responseEmpty()
            ->setJsonContent([
                'list' => $query
                    ->limit($this->getLimit(), $this->getPage())
                    ->execute()
                    ->toArray(),
                'count' => $query
                    ->execute()
                    ->count()
            ]);
    }

}