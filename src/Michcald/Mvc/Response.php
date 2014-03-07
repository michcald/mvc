<?php

namespace Michcald\Mvc;

class Response
{
    private $statusCode;
    
    private $headers = array();
    
    private $content;
    
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        
        return $this;
    }
    
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
        
        return $this;
    }
    
    public function getHeaders()
    {
        return $this->headers;
    }
    
    public function setContent($content)
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getContent()
    {
        return $this->content;
    }
}
