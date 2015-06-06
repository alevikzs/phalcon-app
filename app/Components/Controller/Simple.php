<?php

namespace App\Components\Controller;

use \Phalcon\Http\Response,

    \App\Components\Response\Base\Simple as SimpleResponse,
    \App\Components\Http\Response\Base as HttpResponse;

/**
 * Class Simple
 * @package App\Components\Controller
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