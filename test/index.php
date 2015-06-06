<?php

try {
    (new \Phalcon\Loader())
        ->registerNamespaces([
            'App' => '../app',
            'Rise' => '../rise',
        ])
        ->register();

    (new \App\Bootstrap\Test())->go();
} catch (\Exception $exception) {
    (new \Rise\Http\Response\Error(
        new \Rise\Response\Base\Exception($exception)
    ))->send();
}