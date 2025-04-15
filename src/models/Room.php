<?php
// /var/www/html/hotel2/src/models/Room.php
class Room
{
    public $code;
    public $description;

    public function __construct($code = null, $description = null)
    {
        $this->code = $code;
        $this->description = $description;
    }
}
