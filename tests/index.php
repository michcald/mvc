<?php

include 'init.php';

$request = new Michcald\Mvc\Request();

$request->setMethod('post')
    ->setUri('api/news/5')
    ->setQueryParams($_GET);

//$request->setMethod('cli')->setUri('db:schema:install');

$mvc->run($request);
