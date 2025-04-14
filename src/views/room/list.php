<?php
// /var/www/html/hotel/src/views/room/list.php
$rooms = $facade->getRooms();
?>

<h2>Rooms</h2>
<a href="?entity=room&action=create">Add New Room</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?php echo $room->id; ?></td>
            <td><?php echo $room->name; ?></td>
            <td><?php echo $room->description; ?></td>
            <td>
                <a href="?entity=room&action=update&id=<?php echo $room->id; ?>">Edit</a> |
                <a href="?entity=room&action=delete&id=<?php echo $room->id; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>