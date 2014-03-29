<?php

namespace Michcald\Mvc\Event;

class Event
{
    private $params = array();
    
    public function set($key, $value)
    {
        $this->params[$key] = $value;
        
        return $this;
    }
    
    public function get($key, $default = false)
    {
        if (!array_key_exists($key, $this->params)) {
            return $default;
        }
        
        return $this->params[$key];
    }
}
