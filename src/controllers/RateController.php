<?php
// /var/www/html/hotel/src/controllers/RateController.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../patterns/factory/ModelFactory.php';

class RateController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($roomId, $price)
    {
        $stmt = $this->db->prepare("INSERT INTO rates (room_id, price) VALUES (?, ?)");
        $stmt->execute([$roomId, $price]);
        return ModelFactory::create('rate', ['id' => $this->db->lastInsertId(), 'roomId' => $roomId, 'price' => $price]);
    }

    public function findAll()
    {
        $stmt = $this->db->query("SELECT * FROM rates");
        $rates = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rates[] = ModelFactory::create('rate', $row);
        }
        return $rates;
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM rates WHERE id = ?");
        $stmt->execute([$id]);
        return ModelFactory::create('rate', $stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function update($id, $roomId, $price)
    {
        $stmt = $this->db->prepare("UPDATE rates SET room_id = ?, price = ? WHERE id = ?");
        $stmt->execute([$roomId, $price, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM rates WHERE id = ?");
        $stmt->execute([$id]);
    }
}
