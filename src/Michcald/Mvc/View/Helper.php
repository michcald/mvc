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
    
    protected function getArg($index)
    {
        if (!isset($this->args[$index])) {
            throw new \Exception('Argument not found: ' . $index);
        }
        
        return $this->args[$index];
    }
    
    abstract public function execute();
}
