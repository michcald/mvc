<?php

namespace Michcald\Mvc;

abstract class Container
{
    static private $services = array();

    static public function add($id, $service)
    {
        self::$services[$id] = $service;
    }

    static public function get($id)
    {
        if (!array_key_exists($id, self::$services)) {
            throw new \Exception('Service not found: ' . $id);
        }

        return self::$services[$id];
    }

}
