<?php

namespace App\Components;

use \Phalcon\Mvc\Controller as BaseController,
    \Phalcon\Http\Response;

abstract class Controller extends BaseController {

    public abstract function run();

        /**
     * @param array $data
     * @return Response
     */
    public function response(array $data = []) {
        $response = new Response();
        $response->setContentType('application/json');
        $response->setJsonContent($data);
        return $response;
    }

}