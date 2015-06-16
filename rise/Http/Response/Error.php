<?php

namespace Rise\Http\Response;

use \Rise\Models\Response\Base\Exception as Body,
    \Rise\Http\Response;

/**
 * Class Error
 * @package Rise\Http\Response
 */
class Error extends Response {

    /**
     * @param Body $body
     */
    public function __construct(Body $body) {
        parent::__construct(
            $body,
            500,
            'Internal Server Error'
        );
    }

}