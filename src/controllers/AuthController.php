<?php
// /var/www/html/hotel/src/controllers/AuthController.php
require_once __DIR__ . '/../services/AuthService.php';

class AuthController
{
    private $service;

    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function login($username, $password)
    {
        return $this->service->login($username, $password);
    }
}
