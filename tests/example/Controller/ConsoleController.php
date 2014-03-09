<?php

class ConsoleController extends \Michcald\Mvc\Controller\CliController
{
    public function helpAction()
    {
        $this->writeInfo('Start command');
        
        $this->write('Normal text');
        
        $this->writeInfo('Do you wanna delete this?');
        $this->writeError('This operation will delete everything');
            
        if ($this->confirm()) {
            $this->writeSuccess('Deleted succesfully');
        } else {
            $this->writeWarning('Aborted');
        }

        $response = new \Michcald\Mvc\Response();
        return $response;
    }

}
