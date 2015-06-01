<?php

namespace App\Components\Response;

use \Phalcon\Mvc\Model\Criteria;

/**
 * Class Collection
 * @package App\Components\Response
 */
class Collection extends Body {

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
     * @param array $data
     * @param CollectionMeta $meta
     * @param boolean $success
     * @param boolean $success
     */
    public function __construct(Criteria $query, $data = [], CollectionMeta $meta, $success = true) {
        $this->setQuery($query);
        parent::__construct($data, $meta, $success);
    }

    /**
     * @return array
     */
    public function JsonSerialize() {
        $vars = parent::JsonSerialize();
        unset($vars['query']);

        return $vars;
    }

}