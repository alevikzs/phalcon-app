<?php

namespace Rise\Models\Request\Collection;

/**
 * Class Base
 * @package Rise\Models\Request\Collection
 */
class Base {

    /**
     * @var integer
     */
    public $limit;

    /**
     * @var integer
     */
    public $page;

    /**
     * @var Order
     */
    public $order;

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
     * @return Order[]
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * @param Order[] $order
     * @return $this
     */
    public function setOrder(array $order = []) {
        $this->order = $order;
        return $this;
    }

    /**
     * @param integer $limit
     * @param integer $page
     * @param Order[] $order
     */
    public function __construct($limit = 20, $page = 1, array $order = []) {
        $this
            ->setLimit($limit)
            ->setPage($page)
            ->setOrder($order);
    }

}