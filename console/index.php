<?php

include __DIR__ . "/../vendor/autoload.php";

try {
    /** @var array $argv */
    (new \App\Bootstrap\Console\Live($argv))->go();
} catch (\Exception $exception) {
    echo $exception->getMessage();
}