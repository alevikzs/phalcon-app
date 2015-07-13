<?php

namespace Rise\Bootstrap;

/**
 * Trait TLive
 * @package Rise\Bootstrap
 */
trait TLive {

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