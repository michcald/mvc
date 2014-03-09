<?php

ini_set('display_errors',1); 

include '../vendor/autoload.php';

include 'Controller/Http.php';
include 'Controller/Cli.php';

$mvc = new Michcald\Mvc\Mvc();

// Route 1

$uri = new \Michcald\Mvc\Router\Route\Uri();
$uri->setPattern('api/{repository}/{id}')
    ->setRequirement('id', '\d+');

$route = new Michcald\Mvc\Router\Route();
$route->setId('michcald.ciao')
    ->setMethods(array('GET','POST'))
    ->setUri($uri)
    ->setControllerClass('Http')
    ->setActionName('myAction');

$mvc->addRoute($route);

// Route 2

$uri = new \Michcald\Mvc\Router\Route\Uri();
$uri->setPattern('db:schema:install');

$route = new Michcald\Mvc\Router\Route();
$route->setId('cli.db.schema.install')
    ->setMethods(array('CLI'))
    ->setUri($uri)
    ->setControllerClass('Cli')
    ->setActionName('myAction');

$mvc->addRoute($route);