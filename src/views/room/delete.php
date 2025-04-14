<?php
// /var/www/html/hotel/src/views/room/delete.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de habitación requerido para eliminar");
}

$facade->deleteRoom($id);
header("Location: ?entity=room&action=list");
exit;
