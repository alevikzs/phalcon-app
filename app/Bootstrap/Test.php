<?php

namespace App\Bootstrap;

use \Phalcon\Db\Adapter\Pdo,

    \App\Components\Boot,
    \App\Config\Database;

class Test extends Boot {

    /**
     * @return Pdo
     */
    protected function getDatabase() {
        return Database::getTest();
    }

}