<?php

define("ROOT", dirname(__FILE__));

# новый комментарий
require_once ROOT . '/components/router/Router.php';
require_once ROOT . '/vendor/autoload.php';

$router = new Router();
$router->run();
