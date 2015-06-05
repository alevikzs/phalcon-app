<?php

namespace App\Components\Exception;

use \JsonSerializable as BaseJsonSerializable,

    \Phalcon\Exception as PhalconException;

/**
 * Class Normal
 * @package App\Components\Exception
 */
class Normal extends PhalconException implements BaseJsonSerializable {

    use JsonSerializable;

}