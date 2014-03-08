<?php

namespace Michcald\Mvc;

class Router
{
    private $routes = array();
    
    public function addRoute(Router\Route $route)
    {
        $this->routes[] = $route;
        
        return $this;
    }
    
    public function route(Request $request)
    {
        foreach ($this->routes as $route) {
            
            if ($route->getUri()->match($request->getUri())) {
                return $route;
            }
        }
        
        throw new \Exception('None of the routes match the request');
    }
    
    public function generateUrl($id, array $params)
    {
        //pigliare route, verificare params e requirements
        // generare url
    }
}
