<?php

class ConsoleController extends \Michcald\Mvc\Controller\CliController
{
    public function helpAction()
    {
        $this->writeln('<green>Start command</green>');
        
        $this->writeln('Normal text');
        
        $this->writeln('Do you wanna <cyan>delete</cyan> this?');
        $this->writeln('<bg-red>This operation will delete everything</bg-red>');
            
        if ($this->confirm()) {
            $this->writeln('<bg-green>Deleted succesfully</bg-green>');
        } else {
            $this->writeln('<light-blue>Aborted</light-blue>');
        }

        $response = new \Michcald\Mvc\Response();
        
        return $response;
    }

}
