<?php

namespace App;

use \Phalcon\Config,
    \Phalcon\Mvc\Micro,
    \Phalcon\DI\FactoryDefault,

    \App\Config\Routes;

final class Bootstrap {

    /**
     * @var Micro
     */
    private static $application;

    /**
     * @var FactoryDefault
     */
    private static $dependency;

    /**
     * @var Config
     */
    private static $config;

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
     * @return Config
     */
    public static function getConfig() {
        if (!self::$config) {
            self::$config = require('config/config.php');
        }

        return self::$config;
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
        self::setCustomErrorHandler();

//        try {
            self::setDatabaseDependency();

            self::mountRoutes();

            self::getApplication()->handle();
//        } catch (\Exception $error) {
//            return json_encode([
//                'code' => $error->getCode(),
//                'message' => $error->getMessage()
//            ]);
//        }
//
//        return true;
    }

    private static function setDatabaseDependency() {
        self::getDependency()->set('db', function() {
            self::getConfig()->database->adapter;
            $adapter = "\\Phalcon\\Db\\Adapter\\Pdo\\" . self::getConfig()->database->adapter;
            return new $adapter([
                "host" => self::getConfig()->database->host,
                "username" => self::getConfig()->database->username,
                "password" => self::getConfig()->database->password,
                "dbname" => self::getConfig()->database->dbname
            ]);
        });
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

    public static function setCustomErrorHandler() {
        $handler = function($no, $str, $file, $line) {
//            if (0 === error_reporting()) {
//                return false;
//            }
            throw new \ErrorException($str, 0, $no, $file, $line);
        };
        set_error_handler($handler);
    }

}