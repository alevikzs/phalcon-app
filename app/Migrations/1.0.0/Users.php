<?php 

use \Phalcon\Mvc\Model\Migration;

class UsersMigration_100 extends Migration {

    public function up() {
        $sql = 'CREATE TABLE users (
            id serial NOT NULL,
            name varchar(40) NOT NULL,
            email varchar(40) NOT NULL,
            PRIMARY KEY(id)
        )';
        self::$_connection->execute($sql);
    }

    public function down() {
        $sql = 'DROP TABLE users';
        self::$_connection->execute($sql);
    }

}