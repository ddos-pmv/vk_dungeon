<?php
namespace Dungeon\Models;


require __DIR__ . '\..\..\vendor\autoload.php';

// Load environment variables
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PDO;
use PDOException;


class Database
{
    public $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct()
    {

        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_DATABASE'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password =  $_ENV['DB_PASSWORD'];
    }

    public function connect()
    {
        $dsn = "pgsql:host={$this->host};dbname={$this->dbname}";

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql)
    {
        return $this->pdo->query($sql);
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }
}

