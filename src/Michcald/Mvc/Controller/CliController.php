<?php

namespace Michcald\Mvc\Controller;

abstract class CliController extends \Michcald\Mvc\Controller
{
    final public function write($string)
    {
        echo $string . "\n";
    }
    
    final public function writeError($string)
    {
        echo "\033" . "[41m" . $string . "\033" . "[0m" . "\n";
    }
    
    final public function writeSuccess($string)
    {
        echo "\033" . "[42m" . $string . "\033" . "[0m" . "\n";
    }
    
    final public function writeWarning($string)
    {
        echo "\033" . "[43m" . $string . "\033" . "[0m" . "\n";
    }
    
    final public function writeInfo($string)
    {
        echo "\033" . "[44m" . $string . "\033" . "[0m" . "\n";
    }
    
    final public function confirm()
    {
        $input = $this->readLine();
        
        return in_array(strtolower($input), array(
            'y', 'yes', 'ok'
        ));
    }
    
    final public function readLine()
    {
        return trim(fgets(STDIN));
    }
    
    
}
