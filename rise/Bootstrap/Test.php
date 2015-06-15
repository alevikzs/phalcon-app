<?php

namespace Rise\Bootstrap;

/**
 * Trait Test
 * @package Rise\Bootstrap
 */
trait Test {

    /**
     * @return bool
     */
    public function isLive() {
        return false;
    }

    /**
     * @return bool
     */
    public function isTest() {
        return true;
    }

}