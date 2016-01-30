<?php

namespace App\Migrations;

use \Phalcon\Db\Column,

    \PhRest\Migration;

/**
 * Class M_1434555089_add_password_to_users
 * @package App\Migrations
 */
class M_1434555089_add_password_to_users extends Migration {

    public function up() {
        $this
            ->getDb()
            ->addColumn('users', null,
                new Column('password', [
                    'type' => Column::TYPE_VARCHAR,
                    'size' => 100,
                    'notNull' => true,
                ])
            );
    }

    public function down() {
        $this
            ->getDb()
            ->dropColumn('users', null, 'password');
    }

}