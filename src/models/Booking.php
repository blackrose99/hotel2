<?php
// /var/www/html/hotel2/src/models/Booking.php
class Booking
{
    public $id;
    public $userDocumentId;
    public $roomCode;
    public $rateId;
    public $startDate;
    public $endDate;

    public function __construct($id = null, $userDocumentId = null, $roomCode = null, $rateId = null, $startDate = null, $endDate = null)
    {
        $this->id = $id;
        $this->userDocumentId = $userDocumentId;
        $this->roomCode = $roomCode;
        $this->rateId = $rateId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
}
