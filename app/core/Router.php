<?php

namespace app\core;

use app\core\View;

class Router {

    protected $routes;
    protected $params;
    protected $uri;

    public function __construct(){
        $routes = include(CONFIG.'routes.php');
        $this->routes = $routes;

        $this->uri = trim($_SERVER['REQUEST_URI'], '/');
    }

    public function match() {
        foreach($this->routes as $uriPattern => $patch) {
            if (preg_match('~^'.$uriPattern.'$~', $this->uri)) {
                $internalRoute = preg_replace("~^$uriPattern$~", $patch, $this->uri);


                //Определить контроллер, action, параметры
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments).'Controller';

                $actionName = ucfirst(array_shift($segments).'Action');

                $parameters = $segments;

               // составляем пространство контроллера для автозагрузки класса
                $path = 'app\controllers\\'.ucfirst($controllerName);

                // проверяем существование класса
                if (class_exists($path)) {


                    // проверяем существование метода
                    if (method_exists($path, $actionName)) {

                        // создаем экземпляр контроллера
                        $controller = new $path();

                        // вызываем метод контроллера
                        $controller->$actionName($parameters); //!!!! костыль, нужно обработать входные параметры метода

                        return true;

                    } else {
                        debug('нет метода:'.$action);
                        View::errorCode(404);
                    }
                } else {
                    debug('нет контроллера:'.$path);
                    View::errorCode(404);
                }
            }
        }
    }
    public function run() {
        if(self::match()) {

        } else {
            View::errorCode(404);
        }
    }
}














