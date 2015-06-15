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

    use \Rise\Bootstrap\Test;

    /**
    * @return Pdo
    */
    protected function getDatabase() {
        return Database::getTest();
    }

}