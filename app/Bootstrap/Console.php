<?php

namespace App\Bootstrap;

use \Phalcon\Di\FactoryDefault\Cli,

    \Rise\Bootstrap\Console as BaseConsole,

    \App\Config\Database;

/**
 * Class Console
 * @package App\Bootstrap
 */
class Console extends BaseConsole {

    /**
     * @return Console
     */
    public function createDependencies() {
        $dependency = new Cli();
        $dependency->set('db', function() {
            return Database::get();
        });
        $dependency->set('db_test', function() {
            return Database::getTest();
        });
        $this->setDI($dependency);
        return $this;
    }

}