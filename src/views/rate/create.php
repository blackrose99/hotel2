<?php
// /var/www/html/hotel/src/views/rate/create.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facade->createRate($_POST['roomId'], $_POST['price']);
    header("Location: ?entity=rate&action=list");
    exit;
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary">Create Rate</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="roomId" class="form-label"><i class="material-icons align-middle">hotel</i> Room ID</label>
            <input type="number" class="form-control" id="roomId" name="roomId" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label"><i class="material-icons align-middle">attach_money</i> Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary"><i class="material-icons align-middle">save</i> Create</button>
    </form>
</div>