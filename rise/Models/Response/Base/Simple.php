<?php

namespace Rise\Models\Response\Base;

use \Exception,

    \Rise\Models\Response\Base,
    \Rise\Models\Response\Meta;

/**
 * Class Simple
 * @package Rise\Models\Response\Base
 */
class Simple extends Base {

    /**
     * @var boolean
     */
    public $success;

    /**
     * @var array
     */
    public $data;

    /**
     * @var Meta
     */
    public $meta;

    /**
     * @return boolean
     */
    public function isSuccess() {
        return $this->success;
    }

    /**
     * @param boolean $success
     * @return $this
     */
    public function setSuccess($success) {
        $this->success = $success;
        return $this;
    }

    /**
     * @return array|Exception
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return $this
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     * @return Meta
     */
    public function getMeta() {
        return $this->meta;
    }

    /**
     * @param Meta $meta
     * @return $this
     */
    public function setMeta(Meta $meta) {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @param mixed $data
     * @param Meta $meta
     * @param boolean $success
     */
    public function __construct($data = null, Meta $meta = null, $success = true) {
        $this
            ->setData($data)
            ->setSuccess($success);

        if ($meta) {
            $this->setMeta($meta);
        }
    }

}