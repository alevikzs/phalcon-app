<?php

namespace Rise;

use \JsonSerializable,

    \PhMap\MapperTrait;

/**
 * Class Json
 * @package Rise
 */
abstract class Json implements JsonSerializable {

    use TJsonSerializable;
    use MapperTrait;

}