<?php

namespace Michcald\Mvc\Controller;

abstract class CliController extends \Michcald\Mvc\Controller
{
    private $textColors = array(
        'black'        => '\033[0;30m',
        'red'          => '\033[0;31m',
        'green'        => '\033[0;32m',
        'brown'        => '\033[0;33m',
        'blue'         => '\033[0;34m',
        'purple'       => '\033[0;35m',
        'cyan'         => '\033[0;36m',
        'light-gray'   => '\033[0;37m',
        'darl-gray'    => '\033[1;30m',
        'light-red'    => '\033[1;31m',
        'light-green'  => '\033[1;32m',
        'yellow'       => '\033[1;33m',
        'light-blue'   => '\033[1;34m',
        'light-purple' => '\033[1;35m',
        'light-cyan'   => '\033[1;36m',
        'white'        => '\033[1;37m',
    );
    
    private $bgColors = array(
        'black'      => '\033[0;40m',
        'red'        => '\033[0;41m',
        'green'      => '\033[0;42m',
        'brown'      => '\033[0;43m',
        'blue'       => '\033[0;44m',
        'purple'     => '\033[0;45m',
        'cyan'       => '\033[0;46m',
        'light-gray' => '\033[0;47m'
    );
    
    private function convertToRealColor($string)
    {
        foreach ($this->textColors as $color => $code) {
            $string = str_replace('<' . $color . '>', $code, $string);
            $string = str_replace('</' . $color . '>', "\033[0m", $string);
        }
        
        foreach ($this->bgColors as $color => $code) {
            $string = str_replace('<bg-' . $color . '>', $code, $string);
            $string = str_replace('</bg-' . $color . '>', "\033[0m", $string);
        }
        
        return $string;
    }

    final public function write($string)
    {
        echo $this->convertToRealColor($string);
    }
    
    final public function writeln($string)
    {
        $this->write($string);
        
        echo "\n";
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
