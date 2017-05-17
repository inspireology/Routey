<?php

namespace Routey;

use Exception;

class Routey extends BaseObject
{
    /**
     * @var array
     */
    private $routes         = [];

    /**
     * @var array
     */
    private $appURL         = [];

    /**
     * @var array
     */
    private $namedRoutes    = [];

    /**
     * @var string The base URL of the App with a trailing forward slash ie: http://www.google.com/
     */
    private $appUrl         = '';

    /**
     * @var string The Path of the application on the server
     */
    private $appPath        = '';

    public function  __construct($routes, $configuration)
    {
        if($this->validateRoutes($routes)) {
            $this->setRoutes($routes);
        } else {
            throw new Exception('Invalid routes specified');
        }


    }

    public function __destruct()
    {
    }

    private function matchRequestToRoute($url)
    {
        //iterate over each route
            //check if matches with stripos and the route
            //if it matches return target, params and name to
        return null;
    }

    private function matchServerRequest()
    {
        return $this->matchRequestToRoute($_SERVER['REQUEST_URI']);
    }

    private function checkForLegacyEndPoint($path)
    {
       return file_exists($path) ? true : false;
    }

    private function buildRoute()
    {

    }

    public function executeRoute()
    {
        $route = $this->getRoute();

        //TODO: call route

        //if file exists
            //if prefer legacy
            //else prefer modern
        //else
            //throw exception no action or controller found
    }

    public function getRoute()
    {
        $class      = '';
        $method     = '';
        $parameters = '';

        return [$class, $method, $parameters];
    }

    private function validateRoutes($routes)
    {
        //TODO: validate Routes map to valid endpoints or controllers and methods
        return true;
    }

    /*
    protected function addRoute($newRoute)
    {
        $routes = $this->getRoutes();
        array_push($routes, $newRoute);//Append Route
        $this->setRoutes($routes);
    }

    protected function removeRoute($route)
    {
        //TODO implement remove Route
    }
    */

}
