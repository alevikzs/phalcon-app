<?php

namespace Rise\Bootstrap;

use \Phalcon\Db\Adapter\Pdo;

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

    /**
     * @return Pdo
     */
    public function getDatabase();

}