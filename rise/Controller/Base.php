<?php

namespace Rise\Controller;

use \Phalcon\Mvc\Controller,
    \Phalcon\Http\Response;

/**
 * Class Base
 * @package Rise\Controller
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
        }
        return null;
    }

    /**
     * @param boolean $isAssociative
     * @return mixed
     */
    public function getRawPayload($isAssociative = true) {
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

}