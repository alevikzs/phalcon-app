<?php

namespace App\Rise\Controller;

use \Phalcon\Http\Response,

    \App\Rise\Response\Base\Simple as SimpleResponse,
    \App\Rise\Http\Response\Base as HttpResponse;

/**
 * Class Simple
 * @package App\Rise\Controller
 */
abstract class Simple extends Base {

    /**
     * @param mixed $data
     * @return HttpResponse
     */
    public function response($data = null) {
        $response = new SimpleResponse($data);

        return (new HttpResponse($response));
    }

}