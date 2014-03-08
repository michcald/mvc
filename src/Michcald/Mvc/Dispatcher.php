<?php

namespace Michcald\Mvc;

class Dispatcher
{
    public function dispatch(Request $request, Router\Route $route)
    {
        $controllerClass = $route->getControllerClass();
        
        $controller = new $controllerClass();
        
        $parentClass = get_parent_class($controller);
        
        if (!$parentClass instanceof Controller) {
            throw new \Exception('Controller must extend \\Michcald\\Mvc\\Controller');
        }
        
        $actionName = $route->getActionName();
        
        $uriParams = $route->getUri()->getParams();
        
        $response = call_user_method($actionName, $controller, $uriParams);
        
        if (!$response instanceof Response) {
            throw new \Exception('Action must return \\Michcald\\Mvc\\Response');
        }
        
        return $response;
    }
}
