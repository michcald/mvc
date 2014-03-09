<?php

ini_set('display_errors',1); 

include '../../vendor/autoload.php';

include 'Controller/HttpController.php';
include 'Controller/ConsoleController.php';

$mvc = new Michcald\Mvc\Mvc();

// Route 1

$uri = new \Michcald\Mvc\Router\Route\Uri();
$uri->setPattern('api/{resource}/{id}')
    ->setRequirement('id', '\d+');

$route = new Michcald\Mvc\Router\Route();
$route->setId('api.read')
    ->setMethods(array('GET'))
    ->setUri($uri)
    ->setControllerClass('HttpController')
    ->setActionName('readAction');

$mvc->addRoute($route);

// Route 2

$uri = new \Michcald\Mvc\Router\Route\Uri();
$uri->setPattern('api/{resource}');

$route = new Michcald\Mvc\Router\Route();
$route->setId('api.list')
    ->setMethods(array('GET'))
    ->setUri($uri)
    ->setControllerClass('HttpController')
    ->setActionName('listAction');

$mvc->addRoute($route);

// Route 3

$uri = new \Michcald\Mvc\Router\Route\Uri();
$uri->setPattern('api/{resource}');

$route = new Michcald\Mvc\Router\Route();
$route->setId('api.create')
    ->setMethods(array('POST'))
    ->setUri($uri)
    ->setControllerClass('HttpController')
    ->setActionName('createAction');

$mvc->addRoute($route);

// Route 4

$uri = new \Michcald\Mvc\Router\Route\Uri();
$uri->setPattern('db:schema:help');

$route = new Michcald\Mvc\Router\Route();
$route->setId('cli.db.schema.help')
    ->setMethods(array('CLI'))
    ->setUri($uri)
    ->setControllerClass('ConsoleController')
    ->setActionName('helpAction');

$mvc->addRoute($route);

// Route 5

$uri = new \Michcald\Mvc\Router\Route\Uri();
$uri->setPattern('(.*)');

$route = new Michcald\Mvc\Router\Route();
$route->setId('api.not-found')
    ->setMethods(array('CLI', 'GET', 'POST', 'PUT', 'DELETE'))
    ->setUri($uri)
    ->setControllerClass('HttpController')
    ->setActionName('notFoundAction');

$mvc->addRoute($route);