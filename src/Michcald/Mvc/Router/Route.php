<?php

namespace Michcald\Mvc\Router;

class Route
{
    private $id;
    private $uri;
    private $methods = array();
    private $controllerClass;
    private $actionName;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUri(Route\Uri $uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return \Michcald\Mvc\Router\Route\Uri
     */
    public function getUri()
    {
        return $this->uri;
    }

    public function setMethods(array $methods)
    {
        $this->methods = $methods;

        return $this;
    }

    public function addMethod($method)
    {
        $this->methods[] = $method;

        return $this;
    }

    public function hasMethod($method)
    {
        $method = strtoupper($method);

        return in_array($method, $this->methods);
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function setControllerClass($controllerClass)
    {
        $this->controllerClass = $controllerClass;

        return $this;
    }

    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    public function setActionName($actionName)
    {
        $this->actionName = $actionName;

        return $this;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

}
