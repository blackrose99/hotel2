<?php
// /var/www/html/hotel2/src/views/room/list.php
$rooms = $facade->getRooms();
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">hotel</i> Rooms</h2>
    <a href="?entity=room&action=create" class="btn btn-success mb-3"><i class="material-icons align-middle">add</i> Add New Room</a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!is_array($rooms) || count($rooms) === 0): ?>
                <tr>
                    <td colspan="3" class="text-center">No rooms found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($room->code ?? 'Sin código'); ?></td>
                        <td><?php echo htmlspecialchars($room->description ?? 'Sin descripción'); ?></td>
                        <td>
                            <a href="?entity=room&action=update&code=<?php echo urlencode($room->code ?? ''); ?>" class="btn btn-sm btn-primary"><i class="material-icons">edit</i> Edit</a>
                            <a href="?entity=room&action=delete&code=<?php echo urlencode($room->code ?? ''); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');"><i class="material-icons">delete</i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>