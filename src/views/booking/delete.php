<?php
// /var/www/html/hotel/src/views/booking/delete.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de reserva requerido para eliminar");
}

$facade->deleteBooking($id);
header("Location: ?entity=booking&action=list");
exit;
