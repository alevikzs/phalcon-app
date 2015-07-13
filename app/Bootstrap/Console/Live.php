<?php

namespace App\Bootstrap\Console;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Console,
    \Rise\Config\Local,
    \Rise\Bootstrap\TLive;

/**
 * Class Console
 * @package App\Bootstrap\Console
 */
class Live extends Console {

    use TLive;

    /**
     * @return Pdo
     */
    public function getDatabase() {
        return Local::get()
            ->getDatabase()
            ->getLiveInstance();
    }

}