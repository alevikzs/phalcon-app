<?php

try {
    (new \Phalcon\Loader())
        ->registerNamespaces([
            'App' => '../app',
        ])
        ->register();

    (new \App\Bootstrap\Test())->go();
} catch (\Exception $exception) {
    (new \App\Components\Http\Response\Error(
        new \App\Components\Response\Base\Exception($exception)
    ))->send();
}