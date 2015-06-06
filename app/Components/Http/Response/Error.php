<?php

namespace App\Components\Http\Response;

use \App\Components\Response\Base\Exception as Body;

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
            $body,
            500,
            'Internal Server Error'
        );
    }

}