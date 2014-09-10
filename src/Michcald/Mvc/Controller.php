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

    /**
     * @return \Michcald\Mvc\Request
     */
    final protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @return \Michcald\Mvc\Router
     */
    final protected function getRouter()
    {
        return Container::get('mvc.router');
    }

    /**
     * @return \Michcald\Mvc\Dispatcher
     */
    final protected function getDispatcher()
    {
        return Container::get('mvc.dispatcher');
    }

    /**
     * @return \Michcald\Mvc\Event\Manager
     */
    final protected function getEventManager()
    {
        return Container::get('mvc.event_manager');
    }

    protected function forward($controller, $action, array $params = array())
    {
        $obj = new $controller();

        if (!$obj instanceof Controller) {
            throw new \Exception(sprintf('Class %s must extend \Michcald\Mvc\Controller', $controller));
        }

        $obj->setRequest($this->getRequest());

        return call_user_func_array(array($obj, $action), $params);
    }

}
