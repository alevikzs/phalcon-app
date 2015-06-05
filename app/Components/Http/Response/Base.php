<?php

namespace App\Components\Http\Response;

use \Phalcon\Http\Response;

/**
 * Class Base
 * @package App\Components\Http\Response
 */
class Base extends Response {

    /**
     * @param string|null $content
     * @param int|null $code
     * @param string|null $status
     */
    public function __construct($content = null, $code = null, $status = null) {
        parent::__construct($content, $code, $status);
        $this->setContentType('application/json');
        $this->setHeader('Access-Control-Allow-Origin', '*');
        $this->setHeader('Access-Control-Allow-Methods', 'GET,HEAD,PUT,PATCH,POST,DELETE');
        $this->setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With, Authorization');
    }

}