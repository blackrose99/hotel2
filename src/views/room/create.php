<?php
// /var/www/html/hotel/src/views/room/create.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facade->createRoom($_POST['name'], $_POST['description']);
    header("Location: ?entity=room&action=list");
    exit;
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary">Create Room</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label"><i class="material-icons align-middle">hotel</i> Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label"><i class="material-icons align-middle">description</i> Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="material-icons align-middle">save</i> Create</button>
    </form>
</div>