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

    /**
     * @param \Michcald\Mvc\Request $request
     * @return \Michcald\Mvc\Router\Route
     * @throws \Exception
     */
    public function route(Request $request)
    {
        foreach ($this->routes as $route) {
            if ($route->getUri()->match($request->getUri())) {
                return $route;
            }
        }
        
        throw new \Exception('None of the routes match the request');
    }
    
    public function generateUrl($routeId, array $uriParams)
    {
        foreach ($this->routes as $r) {
            if ($r->getId() == $routeId) {
                $uri = $r->getUri()->generate($uriParams);
                
                return $uri;
            }
        }
        
        throw new \Exception('Route not found: '. $routeId);
    }
}
