<?php
// /var/www/html/hotel2/src/views/user/delete.php

$documentId = $_GET['document_id'] ?? null;
if (!$documentId) {
    echo "<div class='alert alert-danger'>Error: ID de documento no proporcionado.</div>";
    exit;
}

try {
    $userFacade->deleteUser($documentId);
    header("Location: ?entity=user&action=list");
    exit;
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error al eliminar el usuario: " . htmlspecialchars($e->getMessage()) . "</div>";
}
