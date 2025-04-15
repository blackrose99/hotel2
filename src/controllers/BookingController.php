<?php
// /var/www/html/hotel2/src/controllers/BookingController.php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Booking.php';

class BookingController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($booking)
    {
        $stmt = $this->db->prepare("INSERT INTO bookings (user_document_id, room_code, rate_id, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$booking->userDocumentId, $booking->roomCode, $booking->rateId, $booking->startDate, $booking->endDate]);
        return $this->db->lastInsertId();
    }

    public function findAll()
    {
        $stmt = $this->db->query("SELECT id, user_document_id, room_code, rate_id, start_date, end_date FROM bookings");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $bookings = [];
        foreach ($rows as $row) {
            $booking = new Booking();
            $booking->id = $row['id'];
            $booking->userDocumentId = $row['user_document_id'];
            $booking->roomCode = $row['room_code'];
            $booking->rateId = $row['rate_id'];
            $booking->startDate = $row['start_date'];
            $booking->endDate = $row['end_date'];
            $bookings[] = $booking;
        }
        return $bookings;
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT id, user_document_id, room_code, rate_id, start_date, end_date FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $booking = new Booking();
            $booking->id = $row['id'];
            $booking->userDocumentId = $row['user_document_id'];
            $booking->roomCode = $row['room_code'];
            $booking->rateId = $row['rate_id'];
            $booking->startDate = $row['start_date'];
            $booking->endDate = $row['end_date'];
            return $booking;
        }
        return null;
    }

    public function update($booking)
    {
        $stmt = $this->db->prepare("UPDATE bookings SET user_document_id = ?, room_code = ?, rate_id = ?, start_date = ?, end_date = ? WHERE id = ?");
        $stmt->execute([$booking->userDocumentId, $booking->roomCode, $booking->rateId, $booking->startDate, $booking->endDate, $booking->id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
    }
}
