<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include __DIR__ . "/../../vendor/autoload.php";

(new \Phalcon\Loader())
    ->registerNamespaces([
        'App' => '../',
    ])
    ->register();

(new \Phalcon\DI\FactoryDefault())
    ->set('db', function() {
        return \App\Config\Database::getTest();
    });