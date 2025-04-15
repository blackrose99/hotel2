<?php
// /var/www/html/hotel2/src/views/room/update.php
$code = $_GET['code'] ?? null;
if (!$code) {
    throw new Exception("Código de habitación requerido para actualizar");
}
$room = $facade->getRoom($code);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $facade->updateRoom($code, $_POST['description']);
        header("Location: ?entity=room&action=list");
        exit;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">edit</i> Update Room</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="code" class="form-label"><i class="material-icons align-middle">tag</i> Room Code</label>
            <input type="text" class="form-control" id="code" value="<?php echo htmlspecialchars($room->code); ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label"><i class="material-icons align-middle">description</i> Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($room->description); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="material-icons align-middle">save</i> Update</button>
    </form>
</div>