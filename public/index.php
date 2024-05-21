<?php
use Dungeon\Controllers\DungeonController;

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Создание экземпляра FlightPHP
Flight::route('/', function(){
    echo 'Hello World!';
});

// Создание экземпляра DungeonController
$dungeonController = new DungeonController(Flight::app());

// Определение маршрута для загрузки конфигурации
Flight::route('POST /loadConfig', function() use ($dungeonController) {
    // Вызов метода loadConfig у контроллера
    $dungeonController->loadConfig(Flight::request(), Flight::response());
});
Flight::route('POST /start', function() use ($dungeonController) {
    // Вызов метода loadConfig у контроллера
    $dungeonController->start(Flight::request(), Flight::response());
});

// Запуск FlightPHP
Flight::start();
