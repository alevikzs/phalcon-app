<?php

namespace Rise;

use \JsonSerializable;

/**
 * Class Json
 * @package Rise
 */
abstract class Json implements JsonSerializable {

    use TJsonSerializable;
    use TJsonMapper;

}