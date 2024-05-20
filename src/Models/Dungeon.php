<?php
namespace Dungeon\Models;

use Dungeon\Inter\Model;

class Dungeon implements Model
{
    private string $data;
    public function save()
    {

    }

    public function setData(string $data)
    {
        return $this->data = $data;
    }
}