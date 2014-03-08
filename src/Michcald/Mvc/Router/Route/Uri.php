<?php

namespace Michcald\Mvc\Router\Route;

class Uri
{
    private $pattern;
    
    private $requirements = array();
    
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        
        return $this;
    }
    
    public function getPattern()
    {
        return $this->pattern;
    }
    
    public function match($uri)
    {
        if (preg_match('%' . $this->getRegex() . '%', $uri)) {
            return true;
        }
        
        return false;
    }
    
    public function getRegex()
    {
        $uriRegex = $this->pattern;
        
        if ($this->pattern) {
            
            preg_match_all('%\{[^\}]*\}%', $this->pattern, $matches);
            
            foreach ($matches[0] as $uriParam) {
                $uriParam = str_replace(array('{', '}'), array('', ''), $uriParam);
                if (array_key_exists($uriParam, $this->requirements)) {
                    $uriRegex = str_replace(
                        '{' . $uriParam . '}', 
                        $this->requirements[$uriParam], 
                        $uriRegex
                    );
                } else {
                    $uriRegex = str_replace(
                        '{' . $uriParam . '}', 
                        '(.*)', 
                        $uriRegex
                    );
                }
            }
        }
        
        return '^' . $uriRegex . '$';
    }
    
    public function getParam($uri, $name)
    {
        if (!$this->match($uri)) {
            throw new \Exception('Not valid URI for this route');
        }
        
        $patternChunks = explode('/', $this->pattern);
        $uriChunks = explode('/', $uri);
        
        for ($i=0; $i<count($patternChunks); $i++) {
            
            if ($patternChunks[$i] == '{' . $name . '}') {
                return $uriChunks[$i];
            }
            
        }

        throw new \Exception('Invalid URI param: ' . $name);
    }
    
    public function setRequirements(array $requirements)
    {
        $this->requirements = $requirements;
        
        return $this;
    }
    
    public function setRequirement($name, $value)
    {
        $this->requirements[$name] = $value;
        
        return $this;
    }
    
}