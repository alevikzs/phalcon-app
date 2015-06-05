<?php

namespace App\Components\Http\Response;

use \App\Components\Response\Base\Error as Body;

/**
 * Class Error
 * @package App\Components\Http\Response
 */
class Error extends Base {

    /**
     * @param Body $body
     */
    public function __construct(Body $body) {
        parent::__construct(
            null,
            $body->getData()->getCode(),
            $body->getData()->getMessage()
        );

        $this->setJsonContent($body);
    }

}