<?php

namespace App\Migrations;

use \Phalcon\Db\Column,

    \Rise\Migration;

/**
 * Class M_1434359015_episodes
 * @package App\Migrations
 */
class M_1434359015_episodes extends Migration {

    public function up() {
        $this
            ->getDb()
            ->createTable('episodes', null, [
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
                    )
                ]
            ]);
    }

    public function down() {
        $this
            ->getDb()
            ->dropTable('episodes');
    }

}