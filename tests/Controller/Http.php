<?php

class Http extends \Michcald\Mvc\Controller\HttpController
{
    public function myAction($repository, $id)
    {
        $response = new \Michcald\Mvc\Response();
        
        $response->addHeader('Content-Type', 'application/json')
            ->setContent(json_encode(array(
                'prova' => $this->getRouter()->generateUrl('michcald.ciao', array(
                    'repository' => 'cacca',
                    'id' => 5
                ))
            )));
        
        
        return $response;
    }
}
