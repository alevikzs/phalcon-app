<?php

namespace Rise\Controller;

use \Phalcon\Http\Response,

    \Rise\ResponsePayload,
    \Rise\Http\Response as HttpResponse;

/**
 * Class Payload
 * @package Rise\Controller
 */
abstract class Payload extends Simple {

    use TPayload;

}