<?php

namespace Rise;

use \JsonSerializable;

/**
 * Class Base
 * @package Rise
 */
abstract class Base implements JsonSerializable {

    /**
     * @return array
     */
    abstract public function getPublicProperties();

    /**
     * @return array
     */
    public function jsonSerialize() {
        return $this->getPublicProperties();
    }

}