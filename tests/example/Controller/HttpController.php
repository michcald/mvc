<?php

class HttpController extends \Michcald\Mvc\Controller\HttpController
{
    public function readAction($resource, $id)
    {
        $content = $this->getView()->render(
            'views/html/read.phtml',
            array(
                'request'  => $this->getRequest(),
                'resource' => $resource,
                'id'       => $id
            )
        );
        
        $response = new \Michcald\Mvc\Response();
        $response->setContent($content);
        
        return $response;
    }
    
    public function listAction($resource)
    {
        $content = $this->getView()->render(
            'views/html/list.phtml',
            array(
                'request'  => $this->getRequest(),
                'resource' => $resource
            )
        );
        
        $response = new \Michcald\Mvc\Response();
        $response->setContent($content);
        
        return $response;
    }
    
    public function createAction($resource)
    {
        $content = $this->getView()->render(
            'views/html/create.phtml',
            array(
                'request'  => $this->getRequest(),
                'resource' => $resource
            )
        );
        
        $response = new \Michcald\Mvc\Response();
        $response->setContent($content);
        
        return $response;
    }
    
    public function notFoundAction()
    {
        $content = 'Not found';
        
        $response = new \Michcald\Mvc\Response();
        $response->setContent($content);
        
        return $response;
    }
}
