<?php

namespace App\Migrations;

use \App\Components\Migration;

/**
 * Class M_1427063238_serials
 * @package App\Migrations
 */
class M_1427063238_serials extends Migration {

    protected function up() {
        $sql = 'CREATE TABLE serials (
            id serial NOT NULL,
            name varchar(40) NOT NULL,
            PRIMARY KEY(id)
        )';
        $this->execute($sql);
    }

    protected function down() {
        $sql = 'DROP TABLE serials';
        $this->execute($sql);
    }

}