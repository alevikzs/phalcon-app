<?php

use \Phalcon\Mvc\Micro\Collection,
    \Phalcon\Mvc\Micro,
    \App\Controllers\UserController;

(new \Phalcon\Loader())
    ->registerNamespaces([
        'App' => '../app',
    ])
    ->register();

$users = (new Collection())
    ->setHandler(new UserController())
    ->get('/', 'listAction');

$app = (new Micro())
    ->mount($users)
    ->handle();