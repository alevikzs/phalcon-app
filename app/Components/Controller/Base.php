<?php

namespace App\Components\Controller;

use \Phalcon\Mvc\Controller,
    \Phalcon\Http\Response;

/**
 * Class Base
 * @package App\Components\Controller
 */
abstract class Base extends Controller {

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
        } elseif(isset($this->defaultParameters()[$parameter])) {
            return $this->defaultParameters()[$parameter];
        }
        return null;
    }

    /**
     * @return array
     */
    protected function defaultParameters() {
        return [];
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
     * @return Response
     */
    public function responseEmpty() {
        $response = new Response();
        $response->setContentType('application/json');
        return $response;
    }

}