<?php

namespace App\Bootstrap\Web;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Web,

    \App\Config\Database;

/**
 * Class Test
 * @package App\Bootstrap
 */
class Test extends Web {

    use \Rise\Bootstrap\Test;

    /**
     * @return Pdo
     */
    protected function getDatabase() {
        return Database::getTest();
    }

}