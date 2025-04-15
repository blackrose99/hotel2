<?php
// /var/www/html/hotel2/src/models/User.php
class User
{
    public $documentId;
    public $firstName;
    public $lastName;
    public $gender;
    public $password;
    public $role;

    public function __construct($documentId = null, $firstName = null, $lastName = null, $gender = null, $password = null, $role = 'user')
    {
        $this->documentId = $documentId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->password = $password;
        $this->role = $role;
    }
}
