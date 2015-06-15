<?php

namespace Rise\Bootstrap;

/**
 * Trait Live
 * @package Rise\Bootstrap
 */
trait Live {

    /**
     * @return bool
     */
    public function isLive() {
        return true;
    }

    /**
     * @return bool
     */
    public function isTest() {
        return false;
    }

}