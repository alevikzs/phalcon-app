<?php

namespace Rise\Http\Response;

use \Exception,

    \Rise\Models\Response\Base\Exception as Body,
    \Rise\Http\Response;

/**
 * Class Error
 * @package Rise\Http\Response
 */
class Error extends Response {

    const DEFAULT_STATUS_CODE = 500;

    /**
     * @param Body $body
     */
    public function __construct(Body $body) {
        parent::__construct(
            $body,
            $this->getStatusCodeFromException($body->getException())
        );
    }

    /**
     * @param Exception $exception
     * @return integer
     */
    protected function getStatusCodeFromException(Exception $exception) {
        return $this->isStandardCode($exception->getCode()) ? $exception->getCode() : self::DEFAULT_STATUS_CODE;
    }

}