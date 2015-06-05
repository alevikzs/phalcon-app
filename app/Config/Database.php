<?php

namespace App\Config;

use Phalcon\Db\Adapter\Pdo\Postgresql;

/**
 * Class Database
 * @package App\Config
 */
final class Database {

    /**
     * @param string $name
     * @return Postgresql
     */
    private static function instance($name) {
        $settings = [
            'host' => 'localhost',
            'username' => 'postgres',
            'password' => '',
            'dbname' => $name
        ];
        return new Postgresql($settings);
    }

    /**
     * @return Postgresql
     */
    public static function get() {
        return self::instance('phrest');
    }

    /**
     * @return Postgresql
     */
    public static function getTest() {
        return self::instance('phrest_test');
    }

}