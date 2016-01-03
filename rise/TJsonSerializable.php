<?php

namespace Rise;

/**
 * Trait TJsonSerializable
 * @package Rise
 */
trait TJsonSerializable {

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