<?php
// /var/www/html/hotel2/src/views/rate/create.php
$rooms = $facade->getRooms();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $facade->createRate($_POST['roomCode'], $_POST['price']);
        header("Location: ?entity=rate&action=list");
        exit;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">attach_money</i> Create Rate</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="roomCode" class="form-label"><i class="material-icons align-middle">hotel</i> Room</label>
            <select class="form-control" id="roomCode" name="roomCode" required>
                <option value="">Select a room</option>
                <?php foreach ($rooms as $room): ?>
                    <option value="<?php echo htmlspecialchars($room->code); ?>"><?php echo htmlspecialchars($room->code); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label"><i class="material-icons align-middle">attach_money</i> Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary"><i class="material-icons align-middle">save</i> Create</button>
    </form>
</div>