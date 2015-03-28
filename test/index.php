<?php

(new \Phalcon\Loader())
    ->registerNamespaces([
        'App' => '../app',
    ])
    ->register();

(new \App\Bootstrap\Test())->go();