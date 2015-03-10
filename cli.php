<?php

use Phalcon\DI\FactoryDefault\CLI,
    Phalcon\CLI\Console;

$di = new CLI();

$loader = new \Phalcon\Loader();
$loader->registerNamespaces([
    'App' => 'app',
]);
$loader->register();

$console = new Console();
$console->setDI($di);

$arguments = [];
foreach($argv as $k => $arg) {
    if($k == 1) {
        $arguments['task'] = $arg;
    } elseif($k == 2) {
        $arguments['action'] = $arg;
    } elseif($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

try {
    $console->handle($arguments);
}
catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
}