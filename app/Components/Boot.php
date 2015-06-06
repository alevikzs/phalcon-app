<?php

namespace App\Components;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Micro,
    \Phalcon\DI\FactoryDefault,
    \Phalcon\Db\Adapter\Pdo,

    \App\Config\Routes,
    \App\Config\Database,
    \App\Components\Exception\Error,
    \App\Components\Exception\Normal;

/**
 * Class Boot
 * @package App\Components
 */
abstract class Boot extends Micro {

    public function go() {
        self::setCustomErrorHandler();

        $this
            ->createDependencies()
            ->mountRoutes()
            ->handle();
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
            throw new Normal('Not Found', 404);
        });

    }

    protected static function setCustomErrorHandler() {
        ini_set('display_errors', false);

        $exceptionErrorHandler = function($level, $message, $file, $line) {
            if (!(error_reporting() & $level)) {
                return false;
            }
            throw new Error($message, 0, $level, $file, $line);
        };
        set_error_handler($exceptionErrorHandler);

        register_shutdown_function(function () use ($exceptionErrorHandler) {
            $lastError = error_get_last();
            if (error_reporting() & $lastError['type'])
                call_user_func_array($exceptionErrorHandler, $lastError);
        });
    }

}