<?php
// /var/www/html/hotel2/src/patterns/facade/HotelFacade.php
require_once __DIR__ . '/../../controllers/RoomController.php';
require_once __DIR__ . '/../../controllers/RateController.php';
require_once __DIR__ . '/../../controllers/BookingController.php';
require_once __DIR__ . '/../../patterns/builder/BookingBuilder.php';
require_once __DIR__ . '/../../patterns/abstract_factory/ThemeFactory.php';
require_once __DIR__ . '/../../config/Database.php';

class HotelFacade
{
    private $roomController;
    private $rateController;
    private $bookingController;
    private $db;

    public function __construct()
    {
        $this->roomController = new RoomController();
        $this->rateController = new RateController();
        $this->bookingController = new BookingController();
        $this->db = Database::getInstance()->getConnection();
    }

    // Room CRUD
    public function createRoom($code, $description)
    {
        return $this->roomController->create($code, $description);
    }

    public function getRooms()
    {
        return $this->roomController->findAll();
    }

    public function getRoom($code)
    {
        return $this->roomController->findById($code);
    }

    public function updateRoom($code, $description)
    {
        $this->roomController->update($code, $description);
    }

    private function hasBookingsForRoom($roomCode)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM bookings WHERE room_code = ?");
        $stmt->execute([$roomCode]);
        return $stmt->fetchColumn() > 0;
    }

    public function deleteRoom($code)
    {
        if ($this->hasBookingsForRoom($code)) {
            throw new Exception("No se puede eliminar la habitación porque tiene reservas asociadas.");
        }
        $this->roomController->delete($code);
    }

    // Rate CRUD
    public function createRate($roomCode, $price)
    {
        return $this->rateController->create($roomCode, $price);
    }

    public function getRates()
    {
        return $this->rateController->findAll();
    }

    public function getRate($id)
    {
        return $this->rateController->findById($id);
    }

    public function updateRate($id, $roomCode, $price)
    {
        $this->rateController->update($id, $roomCode, $price);
    }

    private function hasBookingsForRate($rateId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM bookings WHERE rate_id = ?");
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
    public function createBooking($userDocumentId, $roomCode, $rateId, $startDate, $endDate)
    {
        $booking = (new BookingBuilder())
            ->setUserDocumentId($userDocumentId)
            ->setRoomCode($roomCode)
            ->setRateId($rateId)
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

    public function updateBooking($id, $userDocumentId, $roomCode, $rateId, $startDate, $endDate)
    {
        $booking = (new BookingBuilder())
            ->setUserDocumentId($userDocumentId)
            ->setRoomCode($roomCode)
            ->setRateId($rateId)
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
