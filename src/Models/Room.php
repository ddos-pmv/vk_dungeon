<?php
namespace Dungeon\Models;

use Dungeon\Inter\Model;
use PDO;
use PDOException;

class Room implements Model
{
    protected $db;
    private $id;
    private $data;

    public function __construct()
    {
        $this->db = new Database();
        $this->db->connect();
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function save()
    {
        $sql = "INSERT INTO rooms (id, data) VALUES (:id, :data)
                ON CONFLICT (id) DO UPDATE SET data = :data";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':data', json_encode($this->data), PDO::PARAM_STR);
        return $stmt->execute();

    }

    public function find(int $roomId)
    {
        $sql = "SELECT * FROM rooms WHERE room_id = :room_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':room_id', $roomId, PDO::PARAM_INT);
        $stmt->execute();
        $room = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($room) {
            $this->id = $room['room_id'];
            $this->data = json_decode($room['data'], true);
            return $this;
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getData()
    {
        return $this->data;
    }
}