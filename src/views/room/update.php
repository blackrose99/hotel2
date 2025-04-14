<?php
// /var/www/html/hotel/src/views/room/update.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de habitación requerido para actualizar");
}
$room = $facade->getRoom($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facade->updateRoom($id, $_POST['name'], $_POST['description']);
    header("Location: ?entity=room&action=list"); // Corregido en el siguiente paso
    exit;
}
?>

<h2>Update Room</h2>
<form method="POST">
    <label>ID: <input type="number" name="id" value="<?php echo $room->id; ?>" readonly></label><br>
    <label>Name: <input type="text" name="name" value="<?php echo $room->name; ?>" required></label><br>
    <label>Description: <textarea name="description" required><?php echo $room->description; ?></textarea></label><br>
    <button type="submit">Update</button>
</form>