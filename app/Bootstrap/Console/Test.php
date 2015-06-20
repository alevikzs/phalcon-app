<?php

namespace App\Bootstrap\Console;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Console,
    \Rise\Config\Local;

/**
 * Class Console
 * @package App\Bootstrap\Console
 */
class Test extends Console {

    use \Rise\Bootstrap\Test;

    /**
     * @return Pdo
     */
    public function getDatabase() {
        return Local::get()
            ->getDatabase()
            ->getTestInstance();
    }

}