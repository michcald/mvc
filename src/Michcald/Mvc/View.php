<?php

namespace Michcald\Mvc;

class View
{
    public function render($file, array $data = array())
    {
        if(!file_exists($file)) {
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