<?php

try {
    (new \Phalcon\Loader())
        ->registerNamespaces([
            'App' => '../app',
            'Rise' => '../rise',
        ])
        ->register();

    (new \App\Bootstrap\Web\Test())->go();
} catch (\Exception $exception) {
    (new \Rise\Http\Response\Error(
        new \Rise\Models\Response\Base\Exception($exception)
    ))->send();
}