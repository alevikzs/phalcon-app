<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

include __DIR__ . "/../../vendor/autoload.php";

(new \Phalcon\DI\FactoryDefault())
    ->set('db', function() {
        return \PhRest\Config\Local::get()
            ->getDatabase()
            ->getTestInstance();
    });