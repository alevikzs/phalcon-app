<?php

namespace App\Components;

use \Phalcon\Mvc\Controller as BaseController,
    \Phalcon\Http\Response;

/**
 * Class Controller
 * @package App\Components
 */
abstract class Controller extends BaseController {

    /**
     * @return Response
     */
    public abstract function run();

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call($name, array $arguments) {
        $parameter = lcfirst(substr($name, 3));
        $parameters = $this->getParams();
        if (isset($parameters[$parameter])) {
            return $parameters[$parameter];
        }
        return null;
    }

    /**
     * @param boolean $isAssociative
     * @return array
     */
    public function getPayload($isAssociative = true) {
        return $this
            ->request
            ->getJsonRawBody($isAssociative);
    }

    /**
     * @return array
     */
    public function getParams() {
        return $this
            ->router
            ->getParams();
    }

    /**
     * @param array $data
     * @return Response
     */
    public function response(array $data = []) {
        $response = new Response();
        $response->setContentType('application/json');
        if ($data) {
            $response->setJsonContent($data);
        }
        return $response;
    }

}