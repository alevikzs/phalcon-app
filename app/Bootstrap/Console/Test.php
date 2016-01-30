<?php

namespace App\Bootstrap\Console;

use \Phalcon\Db\Adapter\Pdo,

    \PhRest\Bootstrap\Console,
    \PhRest\Config\Local,
    \PhRest\Bootstrap\TTest;

/**
 * Class Test
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