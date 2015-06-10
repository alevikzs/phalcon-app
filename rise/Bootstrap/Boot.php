<?php

namespace Rise\Bootstrap;

/**
 * Interface Boot
 * @package Rise\Bootstrap
 */
interface Boot {

    public function go();

    public function createDependencies();

}