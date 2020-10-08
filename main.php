<?php

require_once 'vendor/autoload.php';
require_once 'src/mf/utils/AbstractClassLoader.php';
require_once 'src/mf/utils/ClassLoader.php';

$loader = new \mf\utils\ClassLoader('src');
$loader->register();

use \tweeterapp\model\User;

$config = parse_ini_file('conf/config.ini');

$db = new \Illuminate\Database\Capsule\Manager();

$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

$req = User::select();
$lignes = $req->get();

foreach($lignes as $u) {
    echo 'Nom complet : ' . $u->fullname;
}