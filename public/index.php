<?php

$app = new Phalcon\Mvc\Micro();

$app->get('/', function () {
    echo "Welcome!";
});

$app->handle();