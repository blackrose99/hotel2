<?php
// /var/www/html/hotel2/src/patterns/facade/UserFacade.php
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../config/Database.php';

class UserFacade
{
    private $authController;
    private $db;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->db = Database::getInstance()->getConnection();
    }

    public function login($documentId, $password)
    {
        return $this->authController->login($documentId, $password);
    }

    public function register($documentId, $firstName, $lastName, $gender, $password, $role = 'user')
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE document_id = ?");
        $stmt->execute([$documentId]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("El documento ya está registrado.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (document_id, first_name, last_name, gender, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$documentId, $firstName, $lastName, $gender, $hashedPassword, $role]);
        return $documentId;
    }

    public function getUser($documentId)
    {
        $stmt = $this->db->prepare("SELECT document_id, first_name, last_name, gender, role FROM users WHERE document_id = ?");
        $stmt->execute([$documentId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            throw new Exception("Usuario no encontrado.");
        }
        return $user;
    }

    public function updateUser($documentId, $firstName, $lastName, $gender, $role)
    {
        $stmt = $this->db->prepare("UPDATE users SET first_name = ?, last_name = ?, gender = ?, role = ? WHERE document_id = ?");
        $stmt->execute([$firstName, $lastName, $gender, $role, $documentId]);
    }

    private function hasBookingsForUser($documentId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM bookings WHERE user_document_id = ?");
        $stmt->execute([$documentId]);
        return $stmt->fetchColumn() > 0;
    }

    public function deleteUser($documentId)
    {
        if ($this->hasBookingsForUser($documentId)) {
            throw new Exception("No se puede eliminar el usuario porque tiene reservas asociadas.");
        }
        $stmt = $this->db->prepare("DELETE FROM users WHERE document_id = ?");
        $stmt->execute([$documentId]);
    }

    public function getUsers()
    {
        $stmt = $this->db->query("SELECT document_id, first_name, last_name, gender, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
