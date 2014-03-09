<?php

include 'init.php';

$request = new Michcald\Mvc\Request();

$request->setMethod('CLI')
    ->setUri('db:schema:help');

$mvc->run($request);