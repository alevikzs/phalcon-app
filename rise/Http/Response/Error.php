<?php

namespace Rise\Http\Response;

use \Rise\Models\Response\Base\Exception as Body;

/**
 * Class Error
 * @package Rise\Http\Response
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