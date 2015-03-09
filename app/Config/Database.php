<?php

namespace App\Config;

use Phalcon\Db\Adapter\Pdo\Postgresql;

final class Database {

    public static function get() {
        return new Postgresql([
            'host' => 'localhost',
            'username' => 'postgres',
            'password' => '',
            'dbname' => 'phrest'
        ]);
    }

}