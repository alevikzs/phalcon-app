<?php

use Phalcon\Mvc\Micro\Collection,
    Phalcon\Mvc\Micro;

$app = new Micro();

$users = new Collection();

$app->mount($users);