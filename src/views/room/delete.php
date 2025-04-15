<?php
// /var/www/html/hotel2/src/views/room/delete.php
$code = $_GET['code'] ?? null;
if (!$code) {
    throw new Exception("Código de habitación requerido para eliminar");
}

try {
    $facade->deleteRoom($code);
    header("Location: ?entity=room&action=list");
    exit;
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}
