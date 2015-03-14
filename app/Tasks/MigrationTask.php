<?php

namespace App\Tasks;

use \Phalcon\CLI\Task;

class MigrationTask extends Task {

    public function mainAction() {
        echo "\nThis is the migration task and the main action with \n";
    }

}