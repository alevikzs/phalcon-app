<?php

(new \Phalcon\Loader())
    ->registerNamespaces([
        'App' => '../app',
    ])
    ->register();

\App\Bootstrap\Web::go();