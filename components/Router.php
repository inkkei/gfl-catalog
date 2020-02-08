<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 26.01.2020
 * Time: 22:01
 */

class Router{
    private $routes;

    public function __construct(){
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include ($routesPath);
    }

    // Get a request string
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])){
            return $uri = trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    private function checkAction($controller, $action){
        $actionsList = get_class_methods($controller);
        foreach ($actionsList as $value){
            if($action == $value){
                return $action;
            }
        }
        $action = "actionError";
        return $action;
    }

    public function run()
    {
        $uri = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                // defined a needful Controller and action
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                // Include class-controller
                $controllerFile = ROOT . '/user/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                } else{
                    $controllerFile = ROOT . '/admin/controllers/' . $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    }
                }
                $controllerObject = new $controllerName;
                $actionName = $this->checkAction($controllerObject, $actionName);

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }

            }
        }
    }
}
