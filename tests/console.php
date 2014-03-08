<?php

include 'init.php';

$request = new Michcald\Mvc\Request();

$request->setMethod('CLI')
    ->setUri('db:schema:install');

$mvc->run($request);