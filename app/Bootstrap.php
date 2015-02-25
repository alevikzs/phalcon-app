<?php

namespace App;

use \Phalcon\Mvc\Micro\Collection,
    \Phalcon\Mvc\Micro,
    \Phalcon\DI\FactoryDefault,

    \App\Config\Routes,
    \App\Config\Database;

class Bootstrap {

    /**
     * @var Micro
     */
    private static $application;

    protected function __construct () {}

    /**
     * @return void
     */
    private function __clone() {}

    /**
     * @return Micro
     */
    public static function getInstance() {
        if (!self::$application) {
            self::$application = new Micro(self::createDbDependency());
        }

        return self::$application;
    }

    public static function go() {
        self::mountRoutes()->handle();
    }

    /**
     * @return FactoryDefault
     */
    private static function createDbDependency() {
        $dependency = new FactoryDefault();

        $dependency->set('db', function() {
            return Database::get();
        });

        return $dependency;
    }

    /**
     * @return Micro
     */
    private static function mountRoutes() {
        $routes = Routes::get();

        foreach ($routes as $group => $controllers) {
            foreach ($controllers as $controller) {
                $method = $controller['method'];
                $handler = "$group\\";
                self::getInstance()->$method($controller['route'], $group . $controller['class']);
            }
        }

        return self::getInstance()->getRouter();
    }

}