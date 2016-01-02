<?php

namespace Rise;

use \Rise\Mapper\Object\Json;

/**
 * Trait TJsonMapper
 * @package Rise
 */
trait TJsonMapper {

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