<?php

namespace App\Bootstrap\Web;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Web,
    \Rise\Config\Local,
    \Rise\Bootstrap\TTest;

/**
 * Class Test
 * @package App\Bootstrap
 */
class Test extends Web {

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