<?php

try {
    (new \Phalcon\Loader())
        ->registerNamespaces([
            'App' => 'app',
            'Rise' => 'rise',
        ])
        ->register();

    /** @var array $argv */
    (new \App\Bootstrap\Console($argv))->go();
}
catch (\Exception $exception) {
    echo $exception->getMessage();
}