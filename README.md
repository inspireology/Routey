This is a router that forms part of a personal framework called Legacy.

The goal is to make is possible to progressively refactor a legacy code project in to MVC
while also developing new features.

All of the legacy code can be placed inside of a directory called legacy and using this
router, the either the code in the legacy folder is run or the more modern code is run. 
This is determined by setting routes to map urls to modern code and by specifying if the
legacy file should be used if both newer code and and legacy code exist.
 
```php    
    $configuration = [
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
    
    //create new router
    
    $router = new Routey($configuration);
    
    //route, returns an array of the class and method to call
    $router->route('/auth/login');
    
    $router->route('/auth/login', true);//route ignore legacy file
```
