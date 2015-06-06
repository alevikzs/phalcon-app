<?php

namespace Rise\Response\Base;

use \Exception as BaseException,

    \Rise\Response\Meta;

/**
 * Class Exception
 * @package Rise\Response\Base
 */
class Exception extends Simple {

    /**
     * @param BaseException $exception
     * @param Meta $meta
     */
    public function __construct(BaseException $exception, Meta $meta = null) {
        $this
            ->setData(
                $this->createData($exception)
            )
            ->setSuccess(false);

        if ($meta) {
            $this->setMeta($meta);
        }
    }

    /**
     * @param BaseException $exception
     * @return array
     */
    public function createData(BaseException $exception) {
        return [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace()
        ];
    }

}