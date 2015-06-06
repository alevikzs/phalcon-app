<?php

namespace Rise\Response\Base;

use \Phalcon\Mvc\Model\Criteria,

    \Rise\Response\Meta,
    \Rise\Response\Meta\Collection as MetaCollection;

/**
 * Class Collection
 * @package Rise\Response\Base
 */
class Collection extends Simple {

    /**
     * @var Criteria
     */
    private $query;

    /**
     * @return Criteria
     */
    public function getQuery() {
        return $this->query;
    }

    /**
     * @param Criteria $query
     * @return $this
     */
    public function setQuery(Criteria $query) {
        $this->query = $query;
        return $this;
    }

    /**
     * @param Criteria $query
     */
    public function __construct(Criteria $query) {
        $this
            ->setQuery($query)
            ->setSuccess(true)
            ->createMeta()
            ->createData();
    }

    /**
     * @return $this
     */
    private function createMeta() {
        $query = clone $this->getQuery();

        $limit = $query->getLimit()['number'];
        $offset = $query->getLimit()['offset'];
        $page = $offset / $limit + 1;
        $total = $query->execute()->count();

        return $this->setMeta(new MetaCollection($total, $page, $limit));
    }

    /**
     * @return $this
     */
    private function createData() {
        $query = clone $this->getQuery();

        $data = $query->execute()->toArray();

        return $this->setData($data);
    }

}