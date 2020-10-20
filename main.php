<?php

require_once 'vendor/autoload.php';
require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';

$loader = new \mf\utils\ClassLoader('src');
$loader->register();

use \tweeterapp\model;

$config = parse_ini_file('conf/config.ini');

$db = new \Illuminate\Database\Capsule\Manager();

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();



$router = new \mf\router\Router();

$router->addRoute('home', '/home/', '\tweeterapp\control\TweeterController', 'viewHome');
$router->addRoute('view', '/view/', '\tweeterapp\control\TweeterController', 'viewTweet');
$router->addRoute('user', '/user/', '\tweeterapp\control\TweeterController', 'viewUserTweets');

$router->setDefaultRoute('/home/');

$router->run();