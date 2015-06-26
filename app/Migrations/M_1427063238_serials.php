<?php

namespace App\Migrations;

use \Phalcon\Db\Column,

    \Rise\Migration;

/**
 * Class M_1427063238_serials
 * @package App\Migrations
 */
class M_1427063238_serials extends Migration {

    public function up() {
        $this
            ->getDb()
            ->createTable('serials', null, [
                'columns' => [
                    new Column('id', [
                            'type' => Column::TYPE_INTEGER,
                            'size' => 10,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'primary' => true
                        ]
                    ),
                    new Column('name', [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 100,
                            'notNull' => true,
                        ]
                    ),
                ]
            ]);
    }

    protected function down() {
        $this
            ->getDb()
            ->dropTable('serials');
    }

}