<?php
// /var/www/html/hotel2/src/views/user/update.php

$documentId = $_GET['document_id'] ?? null;
if (!$documentId) {
    echo "<div class='alert alert-danger'>Error: No se proporcionó un ID de documento.</div>";
    exit;
}

$user = $userFacade->getUser($documentId);
if (!$user) {
    echo "<div class='alert alert-danger'>Error: Usuario no encontrado con ID " . htmlspecialchars($documentId) . ".</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $password = !empty($_POST['password']) ? $_POST['password'] : null;
        $userFacade->updateUser(
            $_POST['document_id'],
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['gender'],
            $password,
            $_POST['role']
        );
        header("Location: ?entity=user&action=list");
        exit;
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">edit</i> Update User</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="document_id" class="form-label"><i class="material-icons align-middle">badge</i> Document ID</label>
            <input type="text" class="form-control" id="document_id" name="document_id" value="<?= htmlspecialchars($user['document_id']) ?>" readonly required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label"><i class="material-icons align-middle">person</i> First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label"><i class="material-icons align-middle">person</i> Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label"><i class="material-icons align-middle">wc</i> Gender</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="M" <?= $user['gender'] === 'M' ? 'selected' : '' ?>>Male</option>
                <option value="F" <?= $user['gender'] === 'F' ? 'selected' : '' ?>>Female</option>
                <option value="O" <?= $user['gender'] === 'O' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="material-icons align-middle">lock</i> Password (leave blank to keep unchanged)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password if changing">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label"><i class="material-icons align-middle">security</i> Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="material-icons align-middle">save</i> Update
        </button>
        <a href="?entity=user&action=list" class="btn btn-secondary">
            <i class="material-icons align-middle">cancel</i> Cancel
        </a>
    </form>
</div>