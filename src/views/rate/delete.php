<?php
// /var/www/html/hotel2/src/views/rate/delete.php
$id = $_GET['id'] ?? null;
if (!$id) {
    throw new Exception("ID de tarifa requerido para eliminar");
}

try {
    $facade->deleteRate($id);
    header("Location: ?entity=rate&action=list");
    exit;
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}
