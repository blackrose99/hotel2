<?php
// /var/www/html/hotel/src/controllers/RoomController.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../patterns/factory/ModelFactory.php';

class RoomController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($name, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO rooms (name, description) VALUES (?, ?)");
        $stmt->execute([$name, $description]);
        return ModelFactory::create('room', ['id' => $this->db->lastInsertId(), 'name' => $name, 'description' => $description]);
    }

    public function findAll()
    {
        $stmt = $this->db->query("SELECT * FROM rooms");
        $rooms = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rooms[] = ModelFactory::create('room', $row);
        }
        return $rooms;
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM rooms WHERE id = ?");
        $stmt->execute([$id]);
        return ModelFactory::create('room', $stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function update($id, $name, $description)
    {
        $stmt = $this->db->prepare("UPDATE rooms SET name = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $description, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM rooms WHERE id = ?");
        $stmt->execute([$id]);
    }
}
