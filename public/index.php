<?php
use Dungeon\Controllers\DungeonController;

require __DIR__. '/../vendor/autoload.php';
require __DIR__ . '/../src/Controllers/DungeonController.php';

ini_set('display_errors', 1);

$app = Flight::app();
$router = $app->router();


$dungeonController = new DungeonController($app);

$router->post('/loadConfig', [$dungeonController, 'loadConfig']);
$router->get('/', function (){
    echo 'Hello World!';
});

$app->start();