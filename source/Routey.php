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
     * @var string The base URL of the App without a trailing forward slash ie: http://www.google.com
     */
    private $appUrl         = '';

    /**
     * @var string The Path of the application directory on the server
     */
    private $appRootPath        = '';

    /**
     * @var string The Path of the application directory on the server
     */
    private $legacyAppPath        = '';

    public function  __construct($configuration)
    {
        if($this->validateRoutes($configuration['routes'])) {
            $this->setRoutes($configuration['routes']);

        } else {
            throw new Exception('Invalid routes specified');
        }

        $this->setLegacyAppPath($configuration['legacyAppUrl']);
    }

    public function __destruct()
    {
    }

    private function matchRequestToRoute($url)
    {
        foreach($this->routes as $key => $route) {
            if(preg_match(":^".$url.":",$key)){ //match route to key
               return $route;
            }
        }

        return null;
    }

    public function matchServerRequest()
    {
        return $this->matchRequestToRoute($_SERVER['REQUEST_URI']);
    }

    /**
     * @param $request
     * @return bool true if the path is a legacy end point or false
     */
    private function checkForLegacyEndPoint($request)
    {
        $path = $this->getLegacyAppPath() ."/". $request;
        return file_exists($path) ? true : false;
    }

    /**
     * Get the Route from a url
     *
     * supplying a url will return the first matched route if any exists in the list of routes. If nothing is found null
     * will be returned.
     *
     * @param $url string The url route to
     * @param null $ignoreLegacyEndpoint true and false behave as expected. Null causes $route['ignore'] to be used.
     * @return mixed|null
     */
    public function routeToUrl($url, $ignoreLegacyEndpoint = null)
    {
        $route = $this->matchRequestToRoute($url);

        $returnRoute = null;

        if($route) {
            $legacyFileExists = $this->checkForLegacyEndPoint($url);

            if($legacyFileExists) {

                $legacyRoute = $route;
                $legacyRoute['controller'] = $url;
                $legacyRoute['action'] = '';

                //if the caller specifies to ignore the legacy endpoint do so or else do what is in the route
                if($ignoreLegacyEndpoint === null) { //not set by caller
                    $returnRoute = $route['ignore'] ? $route : $legacyRoute;

                } else if ($ignoreLegacyEndpoint == true){
                    $returnRoute = $route;

                } else if ($ignoreLegacyEndpoint == false){
                    $returnRoute = $legacyRoute;
                }

            } else {
               $returnRoute = $route;
            }

        }
        return $returnRoute;
    }


    private function validateRoutes($routes)
    {
        //TODO: validate Routes map to valid endpoints or controllers and methods
        return true;
    }

    /*******************************************GETTERS & SETTERS******************************************************/

    public function setRoutes($routes)
    {
        if($this->validateRoutes($routes)) $this->routes = $routes;
        else throw new Exception('Unable to set Routes. Invalid Routes array');
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRoute()
    {

        throw new Exception('implement route');
    }

    public function getLegacyAppPath()
    {
        return $this->legacyAppPath;
    }

    public function setLegacyAppPath($path)
    {
        $this->legacyAppPath = $path;
    }

    public function getLegacyAppUrl()
    {
        return $this->legacyAppUrl;
    }
}
