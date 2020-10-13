<?php

require_once 'vendor/autoload.php';
require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';
require_once 'src/mf/router/AbstractRouter.php';
require_once 'src/mf/router/Router.php';

$loader = new \mf\utils\ClassLoader('src');
$loader->register();

use \tweeterapp\model;

$config = parse_ini_file('conf/config.ini');

$db = new \Illuminate\Database\Capsule\Manager();

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();



$router = new \mf\router\Router();

$router->addRoute('maison',
                  '/home/',
                  '\tweeterapp\control\TweeterController',
                  'viewHome');

$router->setDefaultRoute('/home/');

print_r(\mf\router\Router::$routes);

echo $router->run();




// $ctrl = new \tweeterapp\control\TweeterController();
// echo $ctrl->viewHome();