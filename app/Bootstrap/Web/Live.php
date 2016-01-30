<?php

namespace App\Bootstrap\Web;

use \Phalcon\Db\Adapter\Pdo,

    \PhRest\Bootstrap\Web,
    \PhRest\Config\Local,
    \PhRest\Bootstrap\TLive;

/**
 * Class Live
 * @package App\Bootstrap
 */
class Live extends Web {

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