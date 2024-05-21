<?php
namespace Dungeon\Models;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Dungeon\Models\Database;

class Dungeon
{
    private static array $config;
    private static string $filePath = __DIR__ . '/../../data/dungeon_config.json';

    public static function loadConfig(string $json): bool
    {
        $data = json_decode($json, true);

        if (!self::isValidConfig($data)) {
            return false;
        }

        // Сохраняем конфигурацию
        self::$config = $data;

        // Сохраняем в файл
        return self::saveConfigToFile($data);
    }

    private static function isValidConfig(array $data): bool
    {
        if (!isset($data['start']) || !isset($data['end']) || !isset($data['rooms'])) {
            return false;
        }

        if (!is_array($data['rooms'])) {
            return false;
        }

        // Дополнительная валидация

        return true;
    }

    private static function saveConfigToFile(array $data): bool
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);

        if (file_put_contents(self::$filePath, $json) === false) {
            return false;
        }

        return true;
    }

    public static function save_rooms(): bool
    {
        try {
            $database = new Database();
            $database->connect();

            $json = file_get_contents(self::$filePath);

            $data = json_decode($json, true);

            $rooms = $data['rooms'];

            // Очистка таблицы room перед вставкой данных
            $database->query("TRUNCATE TABLE room");

            foreach ($rooms as $room) {
                $sql = "INSERT INTO room (id, data) VALUES (:room_id, :jsonb_data)";
                $stmt = $database->prepare($sql);
                $stmt->bindValue(':room_id', (int)$room['id'], \PDO::PARAM_INT);
                $stmt->bindValue(':jsonb_data', json_encode($room), \PDO::PARAM_STR);
                $stmt->execute();
            }

            return true;
        } catch (\Exception $e) {
            // Логирование ошибки и возврат false в случае неудачи
            echo "error!!!<br>";
            error_log($e->getMessage());
            return false;
        }
    }
    public static function get_start():int
    {
        $json = file_get_contents(self::$filePath);
        $data = json_decode($json, true);

        return $data['start'];
    }

}
