<?php

namespace Rise\Bootstrap;

use \Phalcon\Http\Response,
    \Phalcon\Mvc\Micro,
    \Phalcon\DI\FactoryDefault,
    \Phalcon\Db\Adapter\Pdo,

    \Rise\Exception\Error,
    \Rise\Exception\Normal,

    \App\Config\Routes,
    \App\Config\Database;

/**
 * Class Boot
 * @package Rise
 */
abstract class Web extends Micro implements  Boot {

    public function go() {
        self::setCustomErrorHandler();

        $this
            ->createDependencies()
            ->mountRoutes()
            ->handle();
    }

    /**
     * @return $this
     */
    public function createDependencies() {
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
     * @return $this
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

    public function isLive() {
        return true;
    }

}