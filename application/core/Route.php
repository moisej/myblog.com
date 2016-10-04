<?php

namespace liw\application\core;


class Route
{
    public static function start($conn)
    {
        // Default controller and action name
        $controllerName = 'Post';
        $actionName = 'DisplayAllPosts';

        $routes = explode('/', $_SERVER['REQUEST_URI']);


        // getting name of controller
        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        // getting name of action, which should be described in controller
        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        // getting additional parameters
        if (!empty($routes[3])) {
            $param = $routes[3];
        }

        // adding prefix to controller
        $controllerName = 'Controller'.$controllerName;
        $actionName = 'action'.$actionName;

        // getting name of the file, where current controller is described
        $controllerFile = $controllerName . '.php';

        $controllerPath = "application/controllers/".$controllerFile;

        // check if file exists
        if(!file_exists($controllerPath))
        {
            header("HTTP/1.0 404 Not Found");
            echo 'Error: 404';
            die();
        }

        // initialization of new controller
        $controllerName = 'liw\\application\\controllers\\' . $controllerName;
        $controller = new $controllerName($conn);
        $action = $actionName;

        // check if method exists in controller
        if (method_exists($controller, $action)) {
            // calling method with parameter if it exists
            if ($param) {
                $controller->$action($param);
                unset($param);
            }
            else {
                $controller->$action();
            }
        }
        else {
            header("HTTP/1.0 404 Not Found");
            echo 'Error: 404';
            die();
        }
    }
}