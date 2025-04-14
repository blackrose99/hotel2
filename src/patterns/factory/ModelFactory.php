<?php
// /var/www/html/hotel/src/patterns/factory/ModelFactory.php
require_once __DIR__ . '/../../models/Room.php';
require_once __DIR__ . '/../../models/Rate.php';
require_once __DIR__ . '/../../models/Booking.php';
require_once __DIR__ . '/../../models/User.php';

class ModelFactory
{
    public static function create($type, $data = [])
    {
        switch (strtolower($type)) {
            case 'room':
                return new Room($data['id'] ?? null, $data['name'] ?? null, $data['description'] ?? null);
            case 'rate':
                return new Rate($data['id'] ?? null, $data['roomId'] ?? null, $data['price'] ?? null);
            case 'booking':
                return new Booking($data['id'] ?? null, $data['roomId'] ?? null, $data['rateId'] ?? null, $data['userId'] ?? null, $data['startDate'] ?? null, $data['endDate'] ?? null);
            case 'user':
                return new User($data['id'] ?? null, $data['username'] ?? null, $data['password'] ?? null);
            default:
                throw new Exception("Unknown model type: $type");
        }
    }
}
