<?php

namespace App\Bootstrap\Web;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Web,
    \Rise\Config\Local;

/**
 * Class Test
 * @package App\Bootstrap
 */
class Test extends Web {

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