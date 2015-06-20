<?php

namespace App\Bootstrap\Web;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Web,
    \Rise\Config\Local;

/**
 * Class Web
 * @package App\Bootstrap
 */
class Live extends Web {

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