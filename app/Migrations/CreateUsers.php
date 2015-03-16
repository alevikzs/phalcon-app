<?php

namespace App\Migrations;

use \App\Components\Migration;

class CreateUsers extends Migration {

    public function up() {
        $sql = 'CREATE TABLE users (
            id serial NOT NULL,
            name varchar(40) NOT NULL,
            email varchar(40) NOT NULL,
            PRIMARY KEY(id)
        )';
        $this->getDb()->execute($sql);
    }

    public function down() {
        $sql = 'DROP TABLE users';
        $this->getDb()->execute($sql);
    }

}