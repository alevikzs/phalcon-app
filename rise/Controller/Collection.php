<?php

namespace Rise\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Model\Criteria,

    \Rise\Models\Response\Base\Collection as CollectionResponse,
    \Rise\Http\Response\Base as HttpResponse,
    \Rise\Models\Request\Collection\Base as CollectionPayload;

/**
 * Class Collection
 * @package Rise\Controller
 */
abstract class Collection extends Base {

    /**
     * @return CollectionPayload
     */
    public function getPayload() {
        $rawPayload = $this->getRawPayload();

        return CollectionPayload::cast($rawPayload);
    }

    /**
     * @param Criteria $query
     * @return HttpResponse
     */
    public function response(Criteria $query) {
        $query = $this->buildQuery($query);

        $response = new CollectionResponse($query);

        return (new HttpResponse($response));
    }

    /**
     * @param Criteria $query
     * @return Criteria
     */
    private function buildQuery(Criteria $query) {
        return $query
            ->orderBy(
                $this->getPayload()->getOrderQuery()
            )
            ->limit(
                $this->getPayload()->getLimit(),
                $this->getPayload()->getOffset()
            );
    }

}