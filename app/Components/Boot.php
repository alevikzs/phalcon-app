<?php

namespace App\Components;

use Phalcon\Exception;
use Phalcon\Http\Response;
use \Phalcon\Mvc\Micro,
    \Phalcon\DI\FactoryDefault,
    \Phalcon\Db\Adapter\Pdo,

    \App\Config\Routes,
    \App\Config\Database;

/**
 * Class Boot
 * @package App\Components
 */
abstract class Boot extends Micro {

    public function go() {
        self::setCustomErrorHandler();

        try {
            $this
                ->createDependencies()
                ->mountRoutes()
                ->handle();
        } catch (\Exception $error) {
            echo json_encode([
                'code' => $error->getCode(),
                'message' => $error->getMessage()
            ]);
        }
    }

    /**
     * @return Boot
     */
    protected function createDependencies() {
        $dependency = new FactoryDefault();

        $dependency->set('db', function() {
            return $this->getDatabase();
        });

        $this->setDI($dependency);

        return $this;
    }

    /**
     * @return Pdo
     */
    protected function getDatabase() {
        return Database::get();
    }

    /**
     * @return Boot
     */
    protected function mountRoutes() {
        $routes = Routes::get();

        foreach ($routes as $group => $controllers) {
            foreach ($controllers as $controller) {
                $method = $controller['method'];
                $handlerClass = "\\App\\Controllers\\$group\\" . $controller['class'];
                $this->$method($controller['route'], [new $handlerClass(), 'run']);
            }
        }

        return $this->notFound(function () {
            $this->response->setStatusCode(404, 'Not Found')->sendHeaders();
            throw new Exception('Not Found', 404);
        });

    }

    protected static function setCustomErrorHandler() {
        $handler = function($no, $str, $file, $line) {
            if (0 === error_reporting()) {
                return false;
            }
            throw new \ErrorException($str, 0, $no, $file, $line);
        };
        set_error_handler($handler);
    }

}