<?php

namespace Rise\Controller;

use \Phalcon\Http\Response,
    \Phalcon\Http\Request,

    \Rise\RequestPayload,
    \Rise\Controller;

/**
 * Trait TPayload
 * @package Rise
 * @property Request $request
 * @method mixed getRawPayload()
 */
trait TPayload {

    private static $payload;

    /**
     * @return RequestPayload
     */
    public function getPayload() {
        if (!self::$payload) {
            $rawPayload = $this->getRawPayload();

            /** @var RequestPayload $requestPayloadClass */
            $requestPayloadClass = $this->getRequestPayloadClass();

            self::$payload = $requestPayloadClass::promote($rawPayload);
        }

        return self::$payload;
    }

    /**
     * @return string
     */
    protected abstract function getRequestPayloadClass();

}