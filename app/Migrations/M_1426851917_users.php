<?php

namespace App\Migrations;

use \Phalcon\Db\Column,

    \Rise\Migration;

/**
 * Class M_1426851917_users
 * @package App\Migrations
 */
class M_1426851917_users extends Migration {

    public function up() {
        $this
            ->getDb()
            ->createTable('users', null, [
                'columns' => [
                    new Column('id', [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 10,
                            'notNull' => true,
                            'autoIncrement' => true,
                        ]
                    ),
                    new Column('name', [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 100,
                            'notNull' => true,
                        ]
                    ),
                    new Column('email', [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 100,
                            'notNull' => true,
                        ]
                    )
                ]
            ]);
    }

    public function down() {
        $this
            ->getDb()
            ->dropTable('users');
    }

}