<?php

/**
 * Class Router
 * В классе реалтзовано ЧПУ
 */

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT."/config/routes.php";
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        $uri = null;
        if(!empty($_SERVER["REQUEST_URI"])) {
            $uri = "/".trim($_SERVER["REQUEST_URI"], "/");
        }
        return $uri;
    }

    public function run()
    {
        $uri = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {

                // Получаем внутренний путь из внешнего
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode("/", $internalRoute);

                $controllerName = ucfirst(array_shift($segments)."Controller");

                $actionName = "action".ucfirst(array_shift($segments));

                /*echo "<br>URI: ".$uri;
                echo "<br>Путь: ".$path;
                echo "<br>URI pattern: ".$uriPattern;
                echo "<br>InternalRoute: ".$internalRoute;
                echo "<br>Имя контроллера: ".$controllerName;
                echo "<br>Имя екшена: ".$actionName;*/

                $parameters = $segments;

                $controllerFile = ROOT."/controllers/".$controllerName.".php";

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
    }

}