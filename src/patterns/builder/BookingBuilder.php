<?php
// /var/www/html/hotel2/src/patterns/builder/BookingBuilder.php
class BookingBuilder
{
    public $id;
    public $userDocumentId;
    public $roomCode;
    public $rateId;
    public $startDate;
    public $endDate;

    public function setUserDocumentId($userDocumentId)
    {
        $this->userDocumentId = $userDocumentId;
        return $this;
    }

    public function setRoomCode($roomCode)
    {
        $this->roomCode = $roomCode;
        return $this;
    }

    public function setRateId($rateId)
    {
        $this->rateId = $rateId;
        return $this;
    }

    public function setDates($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        return $this;
    }

    public function build()
    {
        return $this;
    }
}
