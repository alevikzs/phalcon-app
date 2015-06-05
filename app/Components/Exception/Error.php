<?php

namespace App\Components\Exception;

use \JsonSerializable as BaseJsonSerializable,
    \ErrorException;

/**
 * Class Error
 * @package App\Components\Exception
 */
class Error extends ErrorException implements BaseJsonSerializable {

    use JsonSerializable;

}