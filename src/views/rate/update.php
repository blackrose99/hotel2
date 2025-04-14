<?php
// /var/www/html/hotel/src/views/rate/update.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de tarifa requerido para actualizar");
}
$rate = $facade->getRate($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $facade->updateRate($id, $_POST['roomId'], $_POST['price']);
    header("Location: ?entity=rate&action=list"); // Corregido en el siguiente paso
    exit;
}
?>

<h2>Update Rate</h2>
<form method="POST">
    <label>ID: <input type="number" name="id" value="<?php echo $rate->id; ?>" readonly></label><br>
    <label>Room ID: <input type="number" name="roomId" value="<?php echo $rate->roomId; ?>" required></label><br>
    <label>Price: <input type="number" step="0.01" name="price" value="<?php echo $rate->price; ?>" required></label><br>
    <button type="submit">Update</button>
</form>