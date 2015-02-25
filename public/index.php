<?php

(new \Phalcon\Loader())
    ->registerNamespaces([
        'App' => '../app',
    ])
    ->register();

\App\Application::go();