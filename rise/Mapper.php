<?php

namespace Rise;

use \Phalcon\Annotations\Adapter\Memory;

/**
 * Class Mapper
 * @package Rise
 */
class Mapper {

    /**
     * @var string
     */
    private $json;

    /**
     * @var string
     */
    private $class;

    /**
     * @return string
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getJson() {
        return $this->json;
    }

    /**
     * @param string $json
     * @return $this
     */
    public function setJson($json) {
        $this->json = $json;
        return $this;
    }

    public function fromJson() {

    }

    public function fromArray() {

    }

    public function fromObject() {

    }

}