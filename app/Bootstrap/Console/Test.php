<?php

namespace App\Bootstrap\Console;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Console,
    \Rise\Config\Local,
    \Rise\Bootstrap\TTest;

/**
 * Class Console
 * @package App\Bootstrap\Console
 */
class Test extends Console {

    use TTest;

    /**
     * @return Pdo
     */
    public function getDatabase() {
        return Local::get()
            ->getDatabase()
            ->getTestInstance();
    }

}