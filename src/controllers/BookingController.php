<?php
// /var/www/html/hotel/src/controllers/BookingController.php
require_once __DIR__ . '/../services/BookingService.php';

class BookingController
{
    private $service;

    public function __construct()
    {
        $this->service = new BookingService();
    }

    public function create($booking)
    {
        return $this->service->create($booking);
    }

    public function findAll()
    {
        return $this->service->findAll();
    }

    public function findById($id)
    {
        return $this->service->findById($id);
    }

    public function update($booking)
    {
        $this->service->update($booking);
    }

    public function delete($id)
    {
        $this->service->delete($id);
    }
}
