<?php

namespace App;

use \Phalcon\Mvc\Micro,
    \Phalcon\DI\FactoryDefault,

    \App\Config\Routes,
    \App\Config\Database;

final class Bootstrap {

    /**
     * @var Micro
     */
    private static $application;

    private static $dependency;

    private function __construct () {}

    /**
     * @return void
     */
    private function __clone() {}

    /**
     * @return Micro
     */
    public static function getApplication() {
        if (!self::$application) {
            self::$application = new Micro(self::getDependency());
        }

        return self::$application;
    }

    /**
     * @return FactoryDefault
     */
    private static function getDependency() {
        if (!self::$dependency) {
            self::$dependency = new FactoryDefault();
        }

        return self::$dependency;
    }

    public static function go() {
        self::getDependency()->set('db', function() {
            return Database::get();
        });

        self::mountRoutes();

        self::getApplication()->handle();
    }

    private static function mountRoutes() {
        $routes = Routes::get();

        foreach ($routes as $group => $controllers) {
            foreach ($controllers as $controller) {
                $method = $controller['method'];
                $handlerClass = "\\App\\controllers\\$group\\" . $controller['class'];
                self::getApplication()->$method($controller['route'], [new $handlerClass(), 'run']);
            }
        }
    }

}