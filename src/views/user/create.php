<?php
// /var/www/html/hotel2/src/views/user/create.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $userFacade->createUser(
            $_POST['document_id'],
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['gender'],
            $_POST['password'],
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
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">person_add</i> Create User</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="document_id" class="form-label"><i class="material-icons align-middle">badge</i> Document ID</label>
            <input type="text" class="form-control" id="document_id" name="document_id" required maxlength="20">
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label"><i class="material-icons align-middle">person</i> First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label"><i class="material-icons align-middle">person</i> Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label"><i class="material-icons align-middle">wc</i> Gender</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="">Select gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="material-icons align-middle">lock</i> Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label"><i class="material-icons align-middle">security</i> Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="">Select role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="material-icons align-middle">save</i> Create
        </button>
    </form>
</div>