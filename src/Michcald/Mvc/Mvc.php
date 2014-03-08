<?php

namespace Michcald\Mvc;

class Mvc
{
    public function __construct()
    {
        $router = new Router();
        Container::add('mvc.router', $router);
        
        $dispatcher = new Dispatcher();
        Container::add('mvc.dispatcher', $dispatcher);
        
        $view = new View();
        Container::add('mvc.view', $view);
    }
    
    public function addRoute(Router\Route $route)
    {
        Container::get('mvc.router')->addRoute($route);
    }
    
    public function run(Request $request)
    {
        $router = Container::get('mvc.router');
        $route = $router->route($request); // thow exception if not found
        
        $dispatcher = Container::get('mvc.dispatcher');
        $response = $dispatcher->dispatch($request, $route);
        
        // send the response
        foreach ($response->getHeaders() as $header => $value) {
            header($header . ': ' . $value);
        }
        
        echo $response->getContent();
    }
}