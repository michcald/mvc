<?php

namespace Michcald;

class Response
{
    private $method;
    
    private $queryParams = array();
    
    private $data = array();
    
    public function setMethod($method)
    {
        $this->method = $method;
        
        return $this;
    }
    
    public function getMethod()
    {
        return $this->method;
    }
    
    public function addQueryParams($name, $value)
    {
        $this->queryParams[$name] = $value;
        
        return $this;
    }
    
    public function getQueryParam($name, $default = false)
    {
        if (!array_key_exists($name, $this->queryParams)) {
            return $default;
        }
        
        return $this->queryParams[$name];
    }
    
    public function setData(array $data)
    {
        $this->data = $data;
        
        return $this;
    }
    
    public function getData()
    {
        return $this->data;
    }
}
