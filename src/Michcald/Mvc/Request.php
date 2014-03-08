<?php

namespace Michcald\Mvc;

class Request
{
    private $method;
    
    private $uri;
    
    private $queryParams = array();
    
    private $data = array();
    
    private $requestTime;
    
    public function setMethod($method)
    {
        $this->method = $method;
        
        return $this;
    }
    
    public function getMethod()
    {
        return $this->method;
    }
    
    public function setUri($uri)
    {
        $this->uri = $uri;
        
        return $this;
    }
    
    public function getUri()
    {
        return $this->uri;
    }
    
    public function setQueryParams(array $queryParams)
    {
        $this->queryParams = $queryParams;
        
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
    
    public function setRequestTime($time)
    {
        $this->requestTime = $time;
        
        return $this;
    }
    
    public function getRequestTime()
    {
        return $this->requestTime;
    }
}
