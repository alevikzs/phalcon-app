<?php

namespace Rise\Controller;

use \Phalcon\Http\Response,

    \Rise\Controller,
    \Rise\Models\Response\Base\Simple as SimpleResponse,
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
        $response = new SimpleResponse($data);

        return (new HttpResponse($response));
    }

}