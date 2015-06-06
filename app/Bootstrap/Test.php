<?php

namespace App\Bootstrap;

use \Phalcon\Db\Adapter\Pdo,

    \App\Rise\Boot,
    \App\Config\Database;

/**
 * Class Test
 * @package App\Bootstrap
 */
class Test extends Boot {

    /**
     * @return Pdo
     */
    protected function getDatabase() {
        return Database::getTest();
    }

}