<?php

namespace Michcald\Mvc\View;

abstract class Helper
{
    private $args = array();
    
    public final function setArguments(array $arguments)
    {
        $this->args = $arguments;
        
        return $this;
    }
    
    protected function getArg($index, $default = null)
    {
        if (!isset($this->args[$index])) {
            return $default;
        }
        
        return $this->args[$index];
    }
    
    abstract public function execute();
}
