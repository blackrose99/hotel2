<?php
// /var/www/html/hotel2/src/models/Rate.php
class Rate
{
    public $id;
    public $roomCode;
    public $price;

    public function __construct($id = null, $roomCode = null, $price = null)
    {
        $this->id = $id;
        $this->roomCode = $roomCode;
        $this->price = $price;
    }
}
