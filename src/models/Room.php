<?php
// /var/www/html/hotel/src/models/Room.php
class Room
{
    public $id;
    public $name;
    public $description;

    public function __construct($id = null, $name = null, $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}
