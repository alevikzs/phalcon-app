<?php

namespace App\Bootstrap\Console;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Console,
    \Rise\Config\Local;

/**
 * Class Console
 * @package App\Bootstrap\Console
 */
class Live extends Console {

    use \Rise\Bootstrap\Live;

    /**
     * @return Pdo
     */
    public function getDatabase() {
        return Local::get()
            ->getDatabase()
            ->getLiveInstance();
    }

}