<?php

namespace Michcald\Mvc\Event;

class Manager
{
    private $listeners = array();
    
    private function listen($event, $callback)
    {
        $this->listeners[$event][] = $callback;
        
        return $this;
    }
    
    public function dispatch($eventId, Event $event)
    {
        if (array_key_exists($eventId, $this->listeners)) {
            foreach ($this->listeners[$eventId] as $listener) {
                call_user_func_array($listener, array($event));
            }
        }
        
        return $this;
    }
    
    public function addSubscriber(SubscriberInterface $subscriber)
    {
        $listeners = $subscriber->getSubscribedEvents();
        
        foreach ($listeners as $event => $listener) {
            $this->listen($event, array($subscriber, $listener));
        }
    }
}
