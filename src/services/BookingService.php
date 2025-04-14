<?php
// /var/www/html/hotel/src/services/BookingService.php
require_once __DIR__ . '/../config/Database.php';

class BookingService
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($booking)
    {
        $stmt = $this->db->prepare("INSERT INTO bookings (room_id, rate_id, user_id, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$booking->roomId, $booking->rateId, $booking->userId, $booking->startDate, $booking->endDate]);
        return $this->db->lastInsertId();
    }

    public function findAll()
    {
        $stmt = $this->db->query("SELECT * FROM bookings");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($booking)
    {
        $stmt = $this->db->prepare("UPDATE bookings SET room_id = ?, rate_id = ?, user_id = ?, start_date = ?, end_date = ? WHERE id = ?");
        $stmt->execute([$booking->roomId, $booking->rateId, $booking->userId, $booking->startDate, $booking->endDate, $booking->id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
    }
}
