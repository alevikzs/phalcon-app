<?php

namespace App\Components;

use \Phalcon\Mvc\Controller as BaseController,
    \Phalcon\Http\Response;

class Controller extends BaseController {

    /**
     * @param array $data
     * @return Response
     */
    public function response(array $data = []) {
        $response = new Response();
        $response->setContentType('application/json');
        $response->setContent(json_encode($data));
        return $response;
    }

}