<?php

namespace App\Components;

abstract class Migration extends Task {

    abstract public function up();

    abstract public function down();

}