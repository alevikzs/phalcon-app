<?php

namespace App\Bootstrap\Web;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Web,
    \Rise\Config\Local,
    \Rise\Bootstrap\TLive;

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