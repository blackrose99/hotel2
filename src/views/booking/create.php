<?php
// /var/www/html/hotel/src/views/booking/create.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facade->createBooking($_POST['roomId'], $_POST['rateId'], $_POST['userId'], $_POST['startDate'], $_POST['endDate']);
    header("Location: ?entity=booking&action=list");
    exit;
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary">Create Booking</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="roomId" class="form-label"><i class="material-icons align-middle">hotel</i> Room ID</label>
            <input type="number" class="form-control" id="roomId" name="roomId" required>
        </div>
        <div class="mb-3">
            <label for="rateId" class="form-label"><i class="material-icons align-middle">attach_money</i> Rate ID</label>
            <input type="number" class="form-control" id="rateId" name="rateId" required>
        </div>
        <div class="mb-3">
            <label for="userId" class="form-label"><i class="material-icons align-middle">person</i> User ID</label>
            <input type="number" class="form-control" id="userId" name="userId" required>
        </div>
        <div class="mb-3">
            <label for="startDate" class="form-label"><i class="material-icons align-middle">calendar_today</i> Start Date</label>
            <input type="date" class="form-control" id="startDate" name="startDate" required>
        </div>
        <div class="mb-3">
            <label for="endDate" class="form-label"><i class="material-icons align-middle">calendar_today</i> End Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate" required>
        </div>
        <button type="submit" class="btn btn-primary"><i class="material-icons align-middle">save</i> Create</button>
    </form>
</div>