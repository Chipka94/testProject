<?php

define("ROOT", dirname(__FILE__));

// путь к роутеру; автозагрузчику библиотек Composer'а
require_once ROOT . '/components/router/Router.php';
require_once ROOT . '/vendor/autoload.php';

$router = new Router();
$router->run();