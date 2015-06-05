<?php

try {
    (new \Phalcon\Loader())
        ->registerNamespaces([
            'App' => '../app',
        ])
        ->register();

    (new \App\Bootstrap\Web())->go();
} catch (\Exception $exception) {
    (new \App\Components\Http\Response\Error(
        new \App\Components\Response\Base\Error($exception)
    ))->send();
}