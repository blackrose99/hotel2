<?php
// /var/www/html/hotel/src/views/booking/update.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de reserva requerido para actualizar");
}
$booking = $facade->getBooking($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facade->updateBooking($id, $_POST['roomId'], $_POST['rateId'], $_POST['userId'], $_POST['startDate'], $_POST['endDate']);
    header("Location: ?entity=booking&action=list"); // Corregido en el siguiente paso
    exit;
}
?>

<h2>Update Booking</h2>
<form method="POST">
    <label>ID: <input type="number" name="id" value="<?php echo $booking['id']; ?>" readonly></label><br>
    <label>Room ID: <input type="number" name="roomId" value="<?php echo $booking['room_id']; ?>" required></label><br>
    <label>Rate ID: <input type="number" name="rateId" value="<?php echo $booking['rate_id']; ?>" required></label><br>
    <label>User ID: <input type="number" name="userId" value="<?php echo $booking['user_id']; ?>" required></label><br>
    <label>Start Date: <input type="date" name="startDate" value="<?php echo $booking['start_date']; ?>" required></label><br>
    <label>End Date: <input type="date" name="endDate" value="<?php echo $booking['end_date']; ?>" required></label><br>
    <button type="submit">Update</button>
</form>