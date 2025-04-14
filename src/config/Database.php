<?php
 // /var/www/html/hotel/src/config/Database.php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $dsn = "mysql:host=localhost;dbname=hotel;charset=utf8";
        $this->connection = new PDO($dsn, "root", "12345678", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}