<?php

namespace Rise\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Model\Criteria,

    \Rise\Controller,
    \Rise\Http\Response as HttpResponse,
    \Rise\RequestPayload\Collection as CollectionRequestPayload,
    \Rise\ResponsePayload\Collection as CollectionResponsePayload,
    \Rise\ResponsePayload\Meta\Collection as MetaCollection;

/**
 * Class Collection
 * @package Rise\Controller
 * @method CollectionRequestPayload getPayload()
 */
abstract class Collection extends Controller {

    use TPayload;

    /**
     * @return string
     */
    protected function getRequestPayloadClass() {
        return '\Rise\RequestPayload\Collection';
    }

    /**
     * @param Criteria $query
     * @return HttpResponse
     */
    public function response(Criteria $query) {
        if ($this->getPayload()->getOrder()) {
            $query->orderBy(
                $this->getPayload()->getOrderQuery()
            );
        }

        $response = new CollectionResponsePayload(
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