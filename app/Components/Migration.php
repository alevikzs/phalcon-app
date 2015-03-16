<?php

namespace App\Components;

use \App\Components\Task;

abstract class Migration extends Task {

    abstract public function up();

    abstract public function down();

}