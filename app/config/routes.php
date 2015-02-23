<?php

use \Phalcon\Mvc\Router;

$router = new Router();

$router->addGet('/', array(
    'controller' => 'user',
    'action' => 'list',
));

return $router;