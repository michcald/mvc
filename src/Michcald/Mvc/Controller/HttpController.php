<?php

namespace Michcald\Mvc\Controller;

abstract class HttpController extends \Michcald\Mvc\Controller
{
    /**
     * @return \Michcald\Mvc\View
     */
    final protected function getView()
    {
        return Container::get('mvc.view');
    }
}
