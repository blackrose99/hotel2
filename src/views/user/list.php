<?php
// /var/www/html/hotel2/src/views/user/list.php
$users = $userFacade->getUsers();
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">people</i> Users</h2>
    <a href="?entity=user&action=create" class="btn btn-success mb-3">
        <i class="material-icons align-middle">add</i> Add New User
    </a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Document ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="6" class="text-center">No users found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['document_id']) ?></td>
                        <td><?= htmlspecialchars($user['first_name']) ?></td>
                        <td><?= htmlspecialchars($user['last_name']) ?></td>
                        <td><?= htmlspecialchars($user['gender']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <a href="?entity=user&action=update&document_id=<?= urlencode($user['document_id']) ?>" class="btn btn-sm btn-primary">
                                <i class="material-icons">edit</i> Edit
                            </a>
                            <a href="?entity=user&action=delete&document_id=<?= urlencode($user['document_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                                <i class="material-icons">delete</i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>