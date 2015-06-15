<?php

namespace Rise\Bootstrap;

/**
 * Interface Boot
 * @package Rise\Bootstrap
 */
interface Boot {

    public function go();

    /**
     * @return Boot
     */
    public function createDependencies();

    /**
     * @return bool
     */
    public function isLive();

    /**
     * @return bool
     */
    public function isTest();

}