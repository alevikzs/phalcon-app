<?php

namespace App\Bootstrap\Console;

use \Phalcon\Db\Adapter\Pdo,

    \PhRest\Bootstrap\Console,
    \PhRest\Config\Local,
    \PhRest\Bootstrap\TLive;

/**
 * Class Live
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