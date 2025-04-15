<?php
// /var/www/html/hotel2/src/controllers/RateController.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Rate.php';

class RateController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    private function roomExists($roomCode)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM rooms WHERE code = ?");
        $stmt->execute([$roomCode]);
        return $stmt->fetchColumn() > 0;
    }

    public function create($roomCode, $price)
    {
        if (!$this->roomExists($roomCode)) {
            throw new Exception("El código de habitación '$roomCode' no existe.");
        }
        $stmt = $this->db->prepare("INSERT INTO rates (room_code, price) VALUES (?, ?)");
        $stmt->execute([$roomCode, $price]);
        return $this->db->lastInsertId();
    }

    public function findAll()
    {
        $stmt = $this->db->query("SELECT id, room_code, price FROM rates");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rates = [];
        foreach ($rows as $row) {
            $rate = new Rate();
            $rate->id = $row['id'];
            $rate->roomCode = $row['room_code']; // Mapeo manual
            $rate->price = $row['price'];
            $rates[] = $rate;
        }
        return $rates;
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT id, room_code, price FROM rates WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $rate = new Rate();
            $rate->id = $row['id'];
            $rate->roomCode = $row['room_code']; // Mapeo manual
            $rate->price = $row['price'];
            return $rate;
        }
        return null;
    }

    public function update($id, $roomCode, $price)
    {
        if (!$this->roomExists($roomCode)) {
            throw new Exception("El código de habitación '$roomCode' no existe.");
        }
        $stmt = $this->db->prepare("UPDATE rates SET room_code = ?, price = ? WHERE id = ?");
        $stmt->execute([$roomCode, $price, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM rates WHERE id = ?");
        $stmt->execute([$id]);
    }
}
