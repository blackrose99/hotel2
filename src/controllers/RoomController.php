<?php
// /var/www/html/hotel2/src/controllers/RoomController.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Room.php';

class RoomController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($code, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO rooms (code, description) VALUES (?, ?)");
        $stmt->execute([$code, $description]);
        return $this->db->lastInsertId();
    }

    public function findAll()
    {
        $stmt = $this->db->query("SELECT code, description FROM rooms");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rooms = [];
        foreach ($rows as $row) {
            $room = new Room();
            $room->code = $row['code'];
            $room->description = $row['description'];
            $rooms[] = $room;
        }
        return $rooms;
    }

    public function findById($code)
    {
        $stmt = $this->db->prepare("SELECT code, description FROM rooms WHERE code = ?");
        $stmt->execute([$code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $room = new Room();
            $room->code = $row['code'];
            $room->description = $row['description'];
            return $room;
        }
        return null;
    }

    public function update($code, $description)
    {
        $stmt = $this->db->prepare("UPDATE rooms SET description = ? WHERE code = ?");
        $stmt->execute([$description, $code]);
    }

    public function delete($code)
    {
        $stmt = $this->db->prepare("DELETE FROM rooms WHERE code = ?");
        $stmt->execute([$code]);
    }
}
