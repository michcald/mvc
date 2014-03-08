<?php

namespace Michcald\Mvc;

abstract class Controller
{
    private $request;
    
    final public function setRequest(Request $request)
    {
        $this->request = $request;
        
        return $this;
    }
    
    final protected function getRequest()
    {
        return $this->request;
    }
    
    final protected function getView()
    {
        return Container::get('mvc.view');
    }
}