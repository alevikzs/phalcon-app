<?php

namespace Rise;

use \JsonMapper;

/**
 * Trait JsonSerialization
 * @package Rise
 */
trait JsonSerialization {

    /**
     * @param mixed $json
     * @return $this
     */
    public static function promote($json) {
        $mapper = new JsonMapper();
        return $mapper->map($json, new static());
    }

}