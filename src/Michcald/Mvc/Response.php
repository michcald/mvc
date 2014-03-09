<?php

namespace Michcald\Mvc;

class Response
{
    private $statusCode = 200;
    
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
    
    public function send()
    {
        // For 4.3.0 <= PHP <= 5.4.0
        if (!function_exists('http_response_code')) {
            $this->httpResponseCode($this->statusCode);
        }

        foreach ($this->getHeaders() as $header => $value) {
            header($header . ': ' . $value);
        }
        
        echo $this->getContent();
    }
    
    private function httpResponseCode($statusCode)
    {
        header('X-PHP-Response-Code: ' . $statusCode, true, $statusCode);
    }
}
