<?php

namespace Rise\Http;

use \Phalcon\Http\Request as BaseRequest;

/**
 * Class Request
 * @package Rise\Http
 */
class Request extends BaseRequest {

    /**
     * @return string
     */
    public function getAuthorization() {
        return $this->getHeader('Authorization');
    }

    /**
     * @return mixed
     */
    public function getToken() {
        return preg_replace('/.*\s/', '', $this->getAuthorization());
    }

}