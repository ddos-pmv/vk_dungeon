<?php
namespace Dungeon\Controllers;

use Dungeon\Models\Dungeon;
use Dungeon\Models\User;
use Exception;
use Flight;
use flight\Engine;


class DungeonController
{
    protected $app;
    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    public function loadConfig($request, $response)
    {
        $json = $request->getBody();
        if (Dungeon::loadConfig($json)) {
            Flight::json(['status' => 'success']);
        }
        else{
            Flight::json(['status' => 'error', 'message' => 'Invalid configuration'], 400);
        }

    }
    public function start($request, $response)
    {;
        Dungeon::save_rooms();;
        $start_room = Dungeon::get_start();
        echo "start_room-".$start_room."<br>";
        User::init_start($start_room);

    }

}
