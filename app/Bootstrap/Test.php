<?php

namespace App\Bootstrap;

use \Phalcon\Db\Adapter\Pdo,

    \Rise\Bootstrap\Web as BaseWeb,

    \App\Config\Database;

/**
 * Class Test
 * @package App\Bootstrap
 */
class Test extends BaseWeb {

    /**
     * @return Pdo
     */
    protected function getDatabase() {
        return Database::getTest();
    }

}