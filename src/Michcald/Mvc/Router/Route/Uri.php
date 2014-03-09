<?php

namespace Michcald\Mvc\Router\Route;

class Uri
{
    private $paramRegex = '\{[a-zA-Z][a-zA-Z0-9_]*\}';
    
    private $paramRegex2 = '[a-zA-Z][a-zA-Z0-9_]*';
    
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
    
    public function getRegex()
    {
        $uriRegex = $this->pattern;
        
        if ($this->pattern) {
            
            preg_match_all('%' . $this->paramRegex . '%', $this->pattern, $matches);
            
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
                        $this->paramRegex2, 
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
    
    public function getParamKeys()
    {
        $hits = preg_match_all('%' . $this->paramRegex . '%', $this->pattern, $matches);
        
        if (!$hits) {
            return array();
        }
        
        $params = array();
        foreach ($matches[0] as $match) {
            $params[] = str_replace(array('{', '}'), array('', ''), $match);
        }
        
        return $params;
    }
    
    public function getParams(\Michcald\Mvc\Request $request)
    {
        $params = array();
        foreach ($this->getParamKeys() as $key) {
            $params[$key] = $this->getParam($request->getUri(), $key);
        }
        
        return $params;
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

    public function match($uri)
    {
        if (preg_match('%' . $this->getRegex() . '%', $uri)) {
            return true;
        }
        
        return false;
    }
    
    public function generate(array $params)
    {
        $uri = $this->pattern;
        
        // verify if all the params have been provided
        $hits = preg_match_all('%' . $this->paramRegex . '%', $this->pattern, $matches);
        
        foreach ($matches[0] as $p) {
            $field = str_replace(array('{', '}'), array('', ''), $p);
            
            if (array_key_exists($field, $params)) {
                // verify the requirements
                if (array_key_exists($field, $this->requirements)) {
                    if (!preg_match('%^' . $this->requirements[$field] . '$%', $params[$field])) {
                        throw new \Exception('Not valid param: ' . $field);
                    }
                }
                
                $uri = str_replace($p, $params[$field], $uri);
                unset($params[$field]);
            } else {
                throw new \Exception('Missing param: ' . $field);
            }
        }
        
        if (count($params) > 0) {
            $uri .= '?' . http_build_query($params);
        }
        
        return $uri;
    }
}
