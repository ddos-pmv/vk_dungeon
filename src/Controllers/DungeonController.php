<?php

namespace Dungeon\Controllers;

use Dungeon\Models\Dungeon;
use Exception;
use flight\Engine;

class DungeonController
{
    protected $app;
    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    public function loadConfig()
    {
        $body = $this->app->request()->getBody();
        try {
            Dungeon::save($body);
        } catch (Exception $e){
            echo $e;
        }
    }


}