<?php

namespace App\Bootstrap\Console;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Console,

    \App\Config\Database;

/**
 * Class Console
 * @package App\Bootstrap\Console
 */
class Test extends Console {

    /**
    * @return Pdo
    */
    protected function getDatabase() {
        return Database::getTest();
    }

    /**
     * @return bool
     */
    public function isLive() {
        return false;
    }

}