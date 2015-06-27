<?php

namespace Rise;

use \Phalcon\Mvc\Controller as BaseController,
    \Phalcon\Http\Response;

/**
 * Class Base
 * @package Rise
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