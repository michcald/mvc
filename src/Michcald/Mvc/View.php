<?php

namespace Michcald\Mvc;

class View
{
    private $helpers = array();
    
    public function addHelper($className, $id)
    {
        if (!class_exists($className)) {
            throw new \Exception('Helper class does not exist: ' . $className);
        }
        
        $parents = class_parents($className);

        if (!in_array('Michcald\Mvc\View\Helper', $parents)) {
            throw new \Exception(
                'Helper class must extend Michcald\Mvc\View\Helper: ' . $className);
        }
        
        $this->helpers[$id] = $className;
        
        return $this;
    }
    
    public function __call($name, $arguments)
    {
        if (!array_key_exists($name, $this->helpers)) {
            throw new \Exception('Helper not found: ' . $name);
        }
        
        $helperClassName = $this->helpers[$name];
        
        $helper = new $helperClassName();
        
        call_user_func(array($helper, 'setArguments'), $arguments);

        return call_user_func(array($helper, 'execute'));
    }

    public function render($file, array $data = array())
    {
        if (!file_exists($file)) {
            throw new \Exception('View file not found: ' . $file);
        }

        $_ = $data;

        ob_start();
        include $file;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

}
