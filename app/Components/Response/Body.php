<?php

namespace App\Components\Response;

/**
 * Class Body
 * @package App\Components\Response
 */
class Body extends Base {

    /**
     * @var boolean
     */
    private $success;

    /**
     * @var array
     */
    private $data;

    /**
     * @var Meta
     */
    private $meta;

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
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
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
     * @param $data
     * @param Meta $meta
     * @param boolean $success
     */
    public function __construct($data = [], Meta $meta, $success = true) {
        $this
            ->setData($data)
            ->setMeta($meta)
            ->setSuccess($success);
    }

}