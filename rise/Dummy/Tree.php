<?php

namespace Rise\Dummy;

/**
 * Class Tree
 * @package Rise\Dummy
 */
class Tree {

    /**
     * @var double
     */
    public $height;

    /**
     * @var string
     */
    public $name;

    /**
     * @var Branch
     * @Mapper(class="\Rise\Dummy\Branch")
     */
    public $branch;

    /**
     * @return float
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height) {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return Branch
     */
    public function getBranch() {
        return $this->branch;
    }

    /**
     * @param Branch $branch
     */
    public function setBranch(Branch $branch) {
        $this->branch = $branch;
    }

    /**
     * @param double $height
     * @param string $name
     * @param Branch $branch
     */
    public function __construct($height = null, $name = null, Branch $branch = null) {
        $this->height = $height;
        $this->name = $name;
        $this->branch = $branch;
    }

}