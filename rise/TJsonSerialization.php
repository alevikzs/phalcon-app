<?php

namespace Rise;

use \JsonMapper;

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
            $mapper = new JsonMapper();
            return $mapper->map($json, new static());
        }

        return new static();
    }

}