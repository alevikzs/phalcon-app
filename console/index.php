<?php

try {
    (new \Phalcon\Loader())
        ->registerNamespaces([
            'App' => 'app',
            'Rise' => 'rise',
        ])
        ->register();

    /** @var array $argv */
    (new \App\Bootstrap\Console\Live($argv))->go();
} catch (\Exception $exception) {
    echo $exception->getMessage();
}