<?php

namespace Rise\Models\Request\Collection;

use Rise\Models\Request;

/**
 * Class Order
 * @package Rise\Models\Request\Collection
 */
class Order {

    const ORDER_DIRECTION_ASC = 0;

    const ORDER_DIRECTION_DESC = 1;

    /**
     * @var string
     */
    public $field;

    /**
     * @var integer
     */
    public $direction;

    /**
     * @return string
     */
    public function getField() {
        return $this->field;
    }

    /**
     * @param string $field
     * @return $this
     */
    public function setField($field) {
        $this->field = $field;
        return $this;
    }

    /**
     * @return integer
     */
    public function getDirection() {
        return $this->direction;
    }

    /**
     * @param integer $direction
     * @return $this
     */
    public function setDirection($direction) {
        $this->direction = $direction;
        return $this;
    }

    /**
     * @param string|null $field
     * @param integer $direction
     */
    public function __construct($field = null, $direction = self::ORDER_DIRECTION_ASC) {
        $this
            ->setField($field)
            ->setDirection($direction);
    }

    /**
     * @return string
     */
    public function getQuery() {
        $direction = $this->getDirection() === self::ORDER_DIRECTION_ASC ? 'ASC' : 'DESC';

        return $this->getField() . ' ' . $direction;
    }

}