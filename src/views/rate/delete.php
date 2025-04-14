<?php
// /var/www/html/hotel/src/views/rate/delete.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de tarifa requerido para eliminar");
}

$facade->deleteRate($id);
header("Location: ?entity=rate&action=list");
exit;
