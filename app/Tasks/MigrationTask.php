<?php

namespace App\Tasks;

use \Phalcon\Db\Adapter,

    \App\Components\Task;

class MigrationTask extends Task {

    public function getMigrationDirectory() {
        return getcwd() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Migrations';
    }

    public function mainAction() {
        echo "\nMigration task\n";
    }

    public function upAction() {
        echo "\nMigration up\n";
    }

    public function downAction() {
        echo "\nMigration down\n";
    }

}