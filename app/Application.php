<?php

namespace App;

use \Phalcon\Mvc\Micro\Collection,
    \Phalcon\Mvc\Micro,
    \Phalcon\DI\FactoryDefault,

    \App\Config\Routes,
    \App\Config\Database;

class Application {

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

        foreach ($routes as $handler => $group) {
            $collection = (new Collection())
                ->setHandler('\\App\\Controllers\\' . $handler)
                ->setLazy(true);

            foreach ($group as $route) {
                $method = $route['method'];
                $collection->$method($route['route'], $route['action']);
            }

            self::getInstance()->mount($collection);
        }

        return self::getInstance();
    }

}