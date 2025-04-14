<?php
// /var/www/html/hotel/src/models/Booking.php
class Booking
{
    public $id;
    public $roomId;
    public $rateId;
    public $userId;
    public $startDate;
    public $endDate;

    public function __construct($id = null, $roomId = null, $rateId = null, $userId = null, $startDate = null, $endDate = null)
    {
        $this->id = $id;
        $this->roomId = $roomId;
        $this->rateId = $rateId;
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}
