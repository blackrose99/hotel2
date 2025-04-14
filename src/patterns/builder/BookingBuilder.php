<?php
// /var/www/html/hotel/src/patterns/builder/BookingBuilder.php
require_once __DIR__ . '/../../models/Booking.php';

class BookingBuilder
{
    private $booking;

    public function __construct()
    {
        $this->booking = new Booking();
    }

    public function setRoomId($roomId)
    {
        $this->booking->roomId = $roomId;
        return $this;
    }

    public function setRateId($rateId)
    {
        $this->booking->rateId = $rateId;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->booking->userId = $userId;
        return $this;
    }

    public function setDates($startDate, $endDate)
    {
        $this->booking->startDate = $startDate;
        $this->booking->endDate = $endDate;
        return $this;
    }

    public function build()
    {
        return $this->booking;
    }
}
