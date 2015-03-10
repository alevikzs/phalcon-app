<?php

namespace App\Components;

class ResponseBody {

    const STATUS_SUCCESS = 1;
    const STATUS_ERROR = 2;
    const STATUS_WARNING = 3;

    /**
     * @var boolean
     */
    private $status;

    /**
     * @var array
     */
    private $data;

    /**
     * @return integer
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param integer $status
     * @return ResponseBody
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    /**
     * @return ResponseBody
     */
    public function setSuccess() {
        $this->status = self::STATUS_SUCCESS;
        return $this;
    }

    /**
     * @return ResponseBody
     */
    public function setError() {
        $this->status = self::STATUS_ERROR;
        return $this;
    }

    /**
     * @return ResponseBody
     */
    public function setWarning() {
        $this->status = self::STATUS_WARNING;
        return $this;
    }

    /**
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param array $data
     * @return ResponseBody
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

}