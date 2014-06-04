<?php

namespace Michcald\Mvc;

class Dispatcher
{

    public function dispatch(Request $request, Router\Route $route)
    {
        $controllerClass = $route->getControllerClass();

        $controller = new $controllerClass();

        $controller->setRequest($request);

        if (!$controller instanceof Controller) {
            throw new \Exception('Controller must extend \\Michcald\\Mvc\\Controller');
        }

        if (PHP_SAPI != 'cli' && $controller instanceof Controller\CliController) {
            throw new \Exception('Cannot execute script from the web');
        }

        $actionName = $route->getActionName();

        $params = $route->getUri()->getParamKeys();

        $args = $this->getActionArgs($controllerClass, $actionName);

        for ($i = 0; $i < count($args); $i++) {
            if ($args[$i] != $params[$i]) {
                throw new \Exception('Action signature must be: ' . implode(', ', $params));
            }
        }

        $uriParams = $route->getUri()->getParams($request);

        $response = call_user_func_array(array($controller, $actionName), $uriParams);

        if (!$response instanceof Response) {
            throw new \Exception('Action must return \\Michcald\\Mvc\\Response');
        }

        return $response;
    }

    private function getActionArgs($obj, $method)
    {
        $f = new \ReflectionMethod($obj, $method);
        $result = array();
        foreach ($f->getParameters() as $param) {
            $result[] = $param->name;
        }

        return $result;
    }

}
