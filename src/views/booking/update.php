<?php
// /var/www/html/hotel2/src/views/booking/update.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de reserva requerido para actualizar");
}
$booking = $facade->getBooking($id);
$users = $userFacade->getUsers();
$rooms = $facade->getRooms();
$rates = $facade->getRates();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $facade->updateBooking($id, $_POST['userDocumentId'], $_POST['roomCode'], $_POST['rateId'], $_POST['startDate'], $_POST['endDate']);
        header("Location: ?entity=booking&action=list");
        exit;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">edit</i> Update Booking</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="userDocumentId" class="form-label"><i class="material-icons align-middle">person</i> User</label>
            <select class="form-control" id="userDocumentId" name="userDocumentId" required>
                <option value="">Select a user</option>
                <?php if (empty($users)): ?>
                    <option value="" disabled>No users available</option>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo htmlspecialchars($user['document_id']); ?>" <?php echo $user['document_id'] === $booking->userDocumentId ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name'] . ' (' . $user['document_id'] . ')'); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="roomCode" class="form-label"><i class="material-icons align-middle">hotel</i> Room</label>
            <select class="form-control" id="roomCode" name="roomCode" required>
                <option value="">Select a room</option>
                <?php if (empty($rooms)): ?>
                    <option value="" disabled>No rooms available</option>
                <?php else: ?>
                    <?php foreach ($rooms as $room): ?>
                        <option value="<?php echo htmlspecialchars($room->code); ?>" <?php echo $room->code === $booking->roomCode ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($room->code); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="rateId" class="form-label"><i class="material-icons align-middle">attach_money</i> Rate</label>
            <select class="form-control" id="rateId" name="rateId" required>
                <option value="">Select a rate</option>
                <?php if (empty($rates)): ?>
                    <option value="" disabled>No rates available</option>
                <?php else: ?>
                    <?php foreach ($rates as $rate): ?>
                        <option value="<?php echo $rate->id; ?>" <?php echo $rate->id === $booking->rateId ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($rate->roomCode . ' - $' . $rate->price); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="startDate" class="form-label"><i class="material-icons align-middle">calendar_today</i> Start Date</label>
            <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo htmlspecialchars($booking->startDate); ?>" required>
        </div>
        <div class="mb-3">
            <label for="endDate" class="form-label"><i class="material-icons align-middle">calendar_today</i> End Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate" value="<?php echo htmlspecialchars($booking->endDate); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" <?php echo empty($users) || empty($rooms) || empty($rates) ? 'disabled' : ''; ?>>
            <i class="material-icons align-middle">save</i> Update
        </button>
    </form>
</div>