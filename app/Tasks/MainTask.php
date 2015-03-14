<?php

namespace App\Tasks;

use \Phalcon\CLI\Task;

class MainTask extends Task {

    public function mainAction() {
        echo "\nThis is the default task and the default action \n";
    }

}