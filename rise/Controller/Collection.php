<?php

namespace Rise\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Model\Criteria,

    \Rise\Models\Response\Base\Collection as CollectionResponse,
    \Rise\Http\Response as HttpResponse,
    \Rise\Models\Request\Collection\Base as CollectionPayload,
    \Rise\Models\Response\Meta\Collection as MetaCollection;

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
        $query->orderBy(
            $this->getPayload()->getOrderQuery()
        );

        $response = new CollectionResponse(
            $query,
            $this->createMeta($query)
        );

        return (new HttpResponse($response));
    }

    /**
     * @param Criteria $query
     * @return MetaCollection
     */
    private function createMeta(Criteria $query) {
        $metaQuery = clone $query;

        return new MetaCollection(
            $metaQuery->execute()->count(),
            $this->getPayload()->getPage(),
            $this->getPayload()->getLimit()
        );
    }

}