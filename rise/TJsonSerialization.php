<?php

namespace Rise;

use \Rise\Mapper\Object\Json;

/**
 * Trait TJsonSerialization
 * @package Rise
 */
trait TJsonSerialization {

    /**
     * @param mixed $json
     * @return $this
     */
    public static function promote($json) {
        if ($json) {
            $mapper = new Json($json, get_called_class());
            return $mapper->map();
        }

        return new static();
    }

}