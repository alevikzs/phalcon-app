<?php

namespace Rise\Models\Response\Base;

use \Phalcon\Mvc\Model\Criteria,

    \Rise\Models\Response\Meta,
    \Rise\Models\Response\Meta\Collection as MetaCollection;

/**
 * Class Collection
 * @package Rise\Models\Response\Base
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
     * @param MetaCollection $meta
     */
    public function __construct(Criteria $query, $meta) {
        $this
            ->setQuery($query)
            ->setSuccess(true)
            ->setMeta($meta)
            ->createData();
    }

    /**
     * @return $this
     */
    private function createData() {
        /** @var MetaCollection $meta */
        $meta = $this->getMeta();

        $data = $this
            ->getQuery()
            ->limit(
                $meta->getLimit(),
                $meta->getOffset()
            )
            ->execute()
            ->toArray();

        return $this->setData($data);
    }

}