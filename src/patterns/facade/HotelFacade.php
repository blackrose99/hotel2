<?php
// /var/www/html/hotel/src/patterns/facade/HotelFacade.php
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../controllers/RoomController.php';
require_once __DIR__ . '/../../controllers/RateController.php';
require_once __DIR__ . '/../../controllers/BookingController.php';
require_once __DIR__ . '/../../patterns/builder/BookingBuilder.php';
require_once __DIR__ . '/../../patterns/abstract_factory/ThemeFactory.php';

class HotelFacade
{
    private $authController;
    private $roomController;
    private $rateController;
    private $bookingController;

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->roomController = new RoomController();
        $this->rateController = new RateController();
        $this->bookingController = new BookingController();
    }

    // Auth
    public function login($username, $password)
    {
        return $this->authController->login($username, $password);
    }

    // Room CRUD
    public function createRoom($name, $description)
    {
        return $this->roomController->create($name, $description);
    }

    public function getRooms()
    {
        return $this->roomController->findAll();
    }

    public function getRoom($id)
    {
        return $this->roomController->findById($id);
    }

    public function updateRoom($id, $name, $description)
    {
        $this->roomController->update($id, $name, $description);
    }

    private function hasBookingsForRoom($roomId)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM bookings WHERE room_id = ?");
        $stmt->execute([$roomId]);
        return $stmt->fetchColumn() > 0;
    }

    public function deleteRoom($id)
    {
        if ($this->hasBookingsForRoom($id)) {
            throw new Exception("No se puede eliminar la habitación porque tiene reservas asociadas.");
        }
        $this->roomController->delete($id);
    }

    // Rate CRUD
    public function createRate($roomId, $price)
    {
        return $this->rateController->create($roomId, $price);
    }

    public function getRates()
    {
        return $this->rateController->findAll();
    }

    public function getRate($id)
    {
        return $this->rateController->findById($id);
    }

    public function updateRate($id, $roomId, $price)
    {
        $this->rateController->update($id, $roomId, $price);
        
    }

    private function hasBookingsForRate($rateId)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM bookings WHERE rate_id = ?");
        $stmt->execute([$rateId]);
        return $stmt->fetchColumn() > 0;
    }

    public function deleteRate($id)
    {
        if ($this->hasBookingsForRate($id)) {
            throw new Exception("No se puede eliminar la tarifa porque tiene reservas asociadas.");
        }
        $this->rateController->delete($id);
    }

    // Booking CRUD
    public function createBooking($roomId, $rateId, $userId, $startDate, $endDate)
    {
        $booking = (new BookingBuilder())
            ->setRoomId($roomId)
            ->setRateId($rateId)
            ->setUserId($userId)
            ->setDates($startDate, $endDate)
            ->build();
        return $this->bookingController->create($booking);
    }

    public function getBookings()
    {
        return $this->bookingController->findAll();
    }

    public function getBooking($id)
    {
        return $this->bookingController->findById($id);
    }

    public function updateBooking($id, $roomId, $rateId, $userId, $startDate, $endDate)
    {
        $booking = (new BookingBuilder())
            ->setRoomId($roomId)
            ->setRateId($rateId)
            ->setUserId($userId)
            ->setDates($startDate, $endDate)
            ->build();
        $booking->id = $id;
        $this->bookingController->update($booking);
    }

    public function deleteBooking($id)
    {
        $this->bookingController->delete($id);
    }

    // Theme
    public function getTheme($themeName)
    {
        $factory = ThemeProvider::getFactory($themeName);
        return [
            'css' => $factory->createCss(),
            'js' => $factory->createJs()
        ];
    }
}
