<?php

namespace App\Migrations;

use \App\Components\Migration;

class M_1427063238_serials extends Migration {

    public function up() {
        $sql = 'CREATE TABLE serials (
            id serial NOT NULL,
            name varchar(40) NOT NULL,
            PRIMARY KEY(id)
        )';
        $this->getDb()->execute($sql);
    }

    public function down() {
        $sql = 'DROP TABLE serials';
        $this->getDb()->execute($sql);
    }

}