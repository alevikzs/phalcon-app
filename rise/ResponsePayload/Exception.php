<?php

namespace Rise\ResponsePayload;

use \Exception as BaseException,

    \Rise\ResponsePayload,
    \Rise\ResponsePayload\Meta;

/**
 * Class Exception
 * @package Rise\ResponsePayload
 */
class Exception extends ResponsePayload {

    /**
     * @var BaseException
     */
    private $exception;

    /**
     * @return BaseException
     */
    public function getException() {
        return $this->exception;
    }

    /**
     * @param BaseException $exception
     * @return $this
     */
    public function setException(BaseException $exception) {
        $this->exception = $exception;
        return $this;
    }



    /**
     * @param BaseException $exception
     * @param Meta $meta
     */
    public function __construct(BaseException $exception, Meta $meta = null) {
        $this
            ->setException($exception)
            ->setData(
                $this->createData()
            )
            ->setSuccess(false);

        if ($meta) {
            $this->setMeta($meta);
        }
    }

    /**
     * @return array
     */
    private function createData() {
        return [
            'message' => $this->getException()->getMessage(),
            'code' => $this->getException()->getCode(),
            'file' => $this->getException()->getFile(),
            'line' => $this->getException()->getLine(),
            'trace' => $this->getException()->getTrace()
        ];
    }

}