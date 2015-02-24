<?php

namespace App;

use \Phalcon\Mvc\Micro\Collection,
    \Phalcon\Mvc\Micro,

    \App\Config\Routes;

class Bootstrap {

    /**
     * @var Micro
     */
    private $application;

    public function __construct () {
        $this->application = new Micro();
    }

    public function go() {
        $this->routes();

        $this->application->handle();
    }

    private function routes() {
        $routes = Routes::get();

        foreach ($routes as $handler => $group) {
            $collection = (new Collection())
                ->setHandler('\\App\\Controllers\\' . $handler, true);

            foreach ($group as $route) {
                $method = $route['method'];
                $collection->$method($route['route'], $route['action']);
            }

            $this->application->mount($collection);
        }
    }

}