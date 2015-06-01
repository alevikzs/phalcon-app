<?php

namespace App\Components\Response;

use \JsonSerializable;

/**
 * Class Base
 * @package App\Components\Response
 */
abstract class Base implements JsonSerializable {

    /**
     * @return array
     */
    public function JsonSerialize() {
        $vars = get_object_vars($this);

        return $vars;
    }

}