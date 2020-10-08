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

// $tweets = model\Tweet::select()->orderBy('updated_at')->get();
// foreach($tweets as $t) {
//     echo <<<HTML
//     <ul>
//         <li>$t->text</li>
//     </ul>
//     HTML;
// }

// echo '<hr>';

// $positifs = model\Tweet::select()->where('score', '>', 0)->get();
// foreach($positifs as $p) {
//     echo <<<HTML
//     <ul>
//         <li>$p->text</li>
//     </ul>
//     HTML;
// }

$u = model\User::where('id', '=', 1)->first();
$liste_tweets = $u->tweets()->get();