<?php

namespace App\Migrations;

use \Rise\Migration;

/**
 * Class M_1426851917_users
 * @package App\Migrations
 */
class M_1426851917_users extends Migration {

    protected function up() {
        $sql = 'CREATE TABLE users (
            id serial NOT NULL,
            name varchar(40) NOT NULL,
            email varchar(40) NOT NULL,
            PRIMARY KEY(id)
        )';
        $this->execute($sql);
    }

    protected function down() {
        $sql = 'DROP TABLE users';
        $this->execute($sql);
    }

}