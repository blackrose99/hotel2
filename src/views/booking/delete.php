<?php
// /var/www/html/hotel2/src/views/booking/delete.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de reserva requerido para eliminar");
}

try {
    $facade->deleteBooking($id);
    header("Location: ?entity=booking&action=list");
    exit;
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}
