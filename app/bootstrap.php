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
    private $application;

    /**
     * @return Micro
     */
    private function getApplication() {
        return $this->application;
    }

    public function __construct () {
        $this->application = new Micro($this->createDbDependency());
    }

    public function go() {
        $this->mountRoutes()->handle();
    }

    /**
     * @return FactoryDefault
     */
    private function createDbDependency() {
        $dependency = new FactoryDefault();

        $dependency->set('db', function() {
            return Database::get();
        });

        return $dependency;
    }

    /**
     * @return Micro
     */
    private function mountRoutes() {
        $routes = Routes::get();

        foreach ($routes as $handler => $group) {
            $collection = (new Collection())
                ->setHandler('\\App\\Controllers\\' . $handler)
                ->setLazy(true);

            foreach ($group as $route) {
                $method = $route['method'];
                $collection->$method($route['route'], $route['action']);
            }

            $this->getApplication()->mount($collection);
        }

        return $this->getApplication();
    }

}