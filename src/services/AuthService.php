<?php
// /var/www/html/hotel/src/services/AuthService.php
require_once __DIR__ . '/../config/Database.php';

class AuthService
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function login($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }
}
