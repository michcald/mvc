<?php

namespace Michcald\Mvc;

class Router
{
    private $routes = array();
    
    public function __addRoute(Router\Route $route)
    {
        $this->routes[] = $route;
        
        return $this;
    }
}
