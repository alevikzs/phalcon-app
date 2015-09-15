<?php

namespace Rise\Dummy;

/**
 * Class Branch
 * @package Rise\Dummy
 */
class Branch {

    /**
     * @var double
     */
    public $length;

    /**
     * @var Leaf[]
     * @mapper(class="\Rise\Dummy\Leaf", isArray=true)
     */
    public $leaves;

    /**
     * @return float
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * @param float $length
     */
    public function setLength($length) {
        $this->length = $length;
    }

    /**
     * @return Leaf[]
     */
    public function getLeaves() {
        return $this->leaves;
    }

    /**
     * @param Leaf[] $leaves
     */
    public function setLeaves(array $leaves) {
        $this->leaves = $leaves;
    }

    /**
     * @param double $length
     * @param array $leaves
     */
    public function __construct($length = null, array $leaves = []) {
        $this->length = $length;
        $this->leaves = $leaves;
    }

}