<?php

namespace Rise\Bootstrap;

use \Exception,

    \Phalcon\Http\Response,
    \Phalcon\Mvc\Micro,
    \Phalcon\DI\FactoryDefault,
    \Phalcon\Db\Adapter\Pdo,

    \Rise\Exception\Error as ErrorException,
    \Rise\Exception\User as UserException,
    \Rise\Http\Response\Error as ErrorResponse,
    \Rise\Models\Response\Base\Exception as ResponsePayloadException,

    \App\Config\Routes;

/**
 * Class Boot
 * @package Rise
 */
abstract class Web extends Micro implements  Boot {

    public function go() {
        self::setCustomErrorHandler();

        try {
            $this
                ->createDependencies()
                ->mountRoutes()
                ->handle();
        } catch (Exception $exception) {
            (new ErrorResponse(
                new ResponsePayloadException($exception)
            ))->send();
        }
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
            throw new UserException('Not Found', 404);
        });

    }

    protected static function setCustomErrorHandler() {
        ini_set('display_errors', false);

        $exceptionErrorHandler = function($level, $message, $file, $line) {
            if (!(error_reporting() & $level)) {
                return false;
            }
            throw new ErrorException($message, 0, $level, $file, $line);
        };
        set_error_handler($exceptionErrorHandler);

        register_shutdown_function(function () use ($exceptionErrorHandler) {
            $lastError = error_get_last();
            if (error_reporting() & $lastError['type'])
                call_user_func_array($exceptionErrorHandler, $lastError);
        });
    }

}