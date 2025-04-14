<?php
// /var/www/html/hotel/src/models/Rate.php
class Rate
{
    public $id;
    public $roomId;
    public $price;

    public function __construct($id = null, $roomId = null, $price = null)
    {
        $this->id = $id;
        $this->roomId = $roomId;
        $this->price = $price;
    }
}
