<?php

namespace Rise\Bootstrap;

/**
 * Trait TTest
 * @package Rise\Bootstrap
 */
trait TTest {

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