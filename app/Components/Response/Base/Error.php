<?php

namespace App\Components\Response\Base;

use \Exception,

    \App\Components\Response\Meta;

/**
 * Class Error
 * @package App\Components\Response\Base
 */
class Error extends Simple {

    /**
     * @param Exception $exception
     * @param Meta $meta
     */
    public function __construct(Exception $exception, Meta $meta = null) {
        $this
            ->setData($exception)
            ->setSuccess(false);

        if ($meta) {
            $this->setMeta($meta);
        }
    }

}