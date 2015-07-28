<?php

namespace Rise\Bootstrap;

use \Exception,

    \Phalcon\Http\Response,
    \Phalcon\Mvc\Application,
    \Phalcon\DI\FactoryDefault,
    \Phalcon\Db\Adapter\Pdo,
    \Phalcon\Mvc\Router,
    \Phalcon\Mvc\View,

    \Rise\Exception\Error as ErrorException,
    \Rise\Http\Response\Error as ErrorResponse,
    \Rise\ResponsePayload\Exception as ResponsePayloadException,

    \App\Config\Routes;

/**
 * Class Boot
 * @package Rise
 */
abstract class Web extends Application implements  IBoot {

    public function go() {
        self::setCustomErrorHandler();

        try {
            $this
                ->createDependencies()
                ->handle()
                ->send();
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

        $dependency->set('router', function() {
            $router = new Router(false);

            $routes = Routes::get();

            foreach($routes as $group => $controllers){
                foreach ($controllers as $controller) {
                    $router->add(
                        $controller['route'],
                        [
                            'namespace' => "App\\Controllers\\$group",
                            'controller' => $controller['class'],
                            'action' => 'run'
                        ],
                        $controller['method']
                    );
                }
            }

            $router->notFound([
                'namespace' => 'Rise\\Controllers\\NotFound',
                'controller' => 'index',
                'action' => 'run'
            ]);

            return $router;
        });

        $dependency->set('view', function() {
            return new View();
        }, true);

        $this->setDI($dependency);

        return $this;
    }

    protected static function setCustomErrorHandler() {
//        ini_set('display_errors', false);

        $exceptionErrorHandler = function($level, $message, $file, $line) {
            if (!(error_reporting() & $level)) {
                return false;
            }
            throw new ErrorException($message, 0, $level, $file, $line);
        };
        set_error_handler($exceptionErrorHandler);

        register_shutdown_function(function () use ($exceptionErrorHandler) {
            $lastError = error_get_last();
            if ($lastError && error_reporting() && $lastError['type']) {
                call_user_func_array($exceptionErrorHandler, $lastError);
            }
        });
    }

}