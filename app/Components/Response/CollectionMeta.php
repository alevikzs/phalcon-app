<?php

namespace App\Components\Response;

/**
 * Class CollectionMeta
 * @package App\Components\Response
 */
class CollectionMeta extends Meta {

    /**
     * @var integer
     */
    private $total;

    /**
     * @var integer
     */
    private $page;

    /**
     * @var integer
     */
    private $limit;

    /**
     * @var boolean
     */
    private $hasNext;

    /**
     * @return integer
     */
    public function getTotal() {
        return $this->total;
    }

    /**
     * @param integer $total
     * @return $this
     */
    public function setTotal($total) {
        $this->total = $total;
        return $this;
    }

    /**
     * @return integer
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * @param integer $page
     * @return $this
     */
    public function setPage($page) {
        $this->page = $page;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLimit() {
        return $this->limit;
    }

    /**
     * @param integer $limit
     * @return $this
     */
    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return boolean
     */
    public function hasNext() {
        return $this->limit;
    }

    /**
     * @param boolean $hasNext
     * @return $this
     */
    public function setHasNext($hasNext) {
        $this->hasNext = $hasNext;
        return $this;
    }

    /**
     * @param integer $total
     * @param integer $page
     * @param integer $limit
     * @param integer $hasNext
     */
    public function __construct($total, $page, $limit, $hasNext) {
        $this
            ->setTotal($total)
            ->setPage($page)
            ->setLimit($limit)
            ->setHasNext($hasNext);
    }

}