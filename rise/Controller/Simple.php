<?php

namespace Rise\Controller;

use \Phalcon\Http\Response,

    \Rise\Controller,
    \Rise\ResponsePayload,
    \Rise\Http\Response as HttpResponse;

/**
 * Class Simple
 * @package Rise\Controller
 */
abstract class Simple extends Controller {

    /**
     * @param mixed $data
     * @return HttpResponse
     */
    public function response($data = null) {
        $response = new ResponsePayload($data);

        return (new HttpResponse($response));
    }

}