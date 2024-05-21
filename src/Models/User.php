<?php
namespace Dungeon\Models;

use Dungeon\Models\Database;
use Exception;

class User
{
    private string $data;
    private int $currentRoom;
    private static ?Database $database = null;

    public static function initDatabase()
    {
        if (self::$database === null) {
            self::$database = new Database();
            self::$database->connect();
        }
    }

    public function __construct()
    {
        self::initDatabase();
    }

    public static function init_start(int $room_id)
    {
        self::initDatabase();

        try {
            // Очистка таблицы player перед вставкой
            $truncateSql = "TRUNCATE TABLE player";
            self::$database->query($truncateSql);

            // Вставка начального значения в таблицу player
            $sql = "INSERT INTO player (current_room, score) VALUES (:current_room, 0)";
            $stmt = self::$database->prepare($sql);
            $stmt->bindValue(':current_room', $room_id, \PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function save()
    {
        // Реализация метода save для модели User
    }

    public function get_current()
    {
        self::initDatabase();

        try {
            // Получение current_room из таблицы player
            $sql = "SELECT current_room FROM player LIMIT 1";
            $stmt = self::$database->query($sql);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                return $result['current_room'];
            } else {
                throw new Exception("No data found in player table");
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}
