<?php

namespace App\Rise\Controller;

use \Phalcon\Mvc\Controller,
    \Phalcon\Http\Response;

/**
 * Class Base
 * @package App\Rise\Controller
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
    public function getDefaultPayload() {
        return [];
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function getPayloadParameter($alias) {
        $field = null;

        if ($payload = $this->getPayload()) {
            $field = $this->getFieldFromArray($alias, $payload);
        }

        if (is_null($field)) {
            $field = $this->getFieldFromArray($alias, $this->getDefaultPayload());
        }

        return $field;
    }

    /**
     * @param string $alias
     * @param array $array
     * @return mixed
     */
    protected function getFieldFromArray($alias, array $array) {
        $isLastFieldSet = false;

        $fieldsStructure = explode('.', $alias);

        foreach ($fieldsStructure as $field) {
            $isLastFieldSet = false;

            if (isset($array[$field])) {
                $array = $array[$field];

                $isLastFieldSet = true;
            } else {
                break;
            }
        }

        return $isLastFieldSet ? $array : null;
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