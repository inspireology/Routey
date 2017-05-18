<?php

namespace RouteyTest\Test;
use PHPUnit_Framework_TestCase;
use Routey\Routey;

class RouteyTest extends PHPUnit_Framework_TestCase
{
    private $configuration;

    public function setUp()
    {
        $this->configuration = [
            'routes' => [
                '/user/update.php' => ['controller' => '/user/', 'action' => 'update', 'ignore' => true],
                '/user/delete.php' => ['controller' => '/user/', 'action' => 'delete', 'ignore' => true],
                '/user/view.php' => ['controller' => '/user/', 'action' => 'view', 'ignore' => true],
                '/user/' => ['controller' => '/user/', 'action' => 'index', 'ignore' => true]
            ],

            'appUrl' => 'localhost/',
            'appRootPath' => __DIR__ . '/../',
            'legacyAppPath' => __DIR__ . '/../Fixtures/',
        ];
    }

    public function tearDown()
    {
    }

    public function testMatchRoutes()
    {
        $router = new Routey($this->configuration);
        $route = $router->routeToUrl('/user/update.php');

        $this->assertEquals($this->configuration['routes']['/user/update.php'], $route, "Route Not Matched");
    }

    public function testRouteToInvalidUrl()
    {
        $router = new Routey($this->configuration);
        $route = $router->routeToUrl('/user/renew.php');

        //$this->assertEquals(null, $route, "Invalid URLs return null route");
    }

    public function testRouteToValidController()
    {
        $router = new Routey($this->configuration);
        $route = $router->routeToUrl('/user/');//

        $this->assertEquals('/user/', $route['controller'], "Routed to Wrong Controller {$route['controller']}");
    }

    public function testRouteToInvalidController()
    {
        $router = new Routey($this->configuration);
        $route = $router->routeToUrl('/user/renew.php');//

        $this->assertEquals(null, $route['controller'], "Routed to Valid Controller when expecting null");
    }

}
