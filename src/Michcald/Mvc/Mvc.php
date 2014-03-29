<?php

namespace Michcald\Mvc;

class Mvc
{

    public function __construct()
    {
        $router = new Router();
        Container::add('mvc.router', $router);

        $event = new Event\Manager();
        Container::add('mvc.event_manager', $event);
        
        $dispatcher = new Dispatcher();
        Container::add('mvc.dispatcher', $dispatcher);

        $view = new View();
        Container::add('mvc.view', $view);
    }

    public function addRoute(Router\Route $route)
    {
        Container::get('mvc.router')->addRoute($route);
        
        return $this;
    }
    
    public function addEventSubscriber(Event\SubscriberInterface $subscriber)
    {
        Container::get('mvc.event_manager')->addSubscriber($subscriber);
        
        return $this;
    }

    public function run(Request $request)
    {
        $router = Container::get('mvc.router');
        $route = $router->route($request);

        $eventManager = Container::get('mvc.event_manager');

        $event = new Event\Event();
        $event->set('mvc.request', $request);
        
        $eventManager->dispatch('mvc.event.dispatch.pre', $event);
        
        $dispatcher = Container::get('mvc.dispatcher');
        $response = $dispatcher->dispatch($request, $route);

        $event->set('mvc.response', $response);
        
        $eventManager->dispatch('mvc.event.dispatch.post', $event);
        
        $response->send();
    }

}
