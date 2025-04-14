<?php
// /var/www/html/hotel/src/views/booking/list.php
$bookings = $facade->getBookings();
?>

<h2>Bookings</h2>
<a href="?entity=booking&action=create">Add New Booking</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Room ID</th>
        <th>Rate ID</th>
        <th>User ID</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?php echo $booking['id']; ?></td>
            <td><?php echo $booking['room_id']; ?></td>
            <td><?php echo $booking['rate_id']; ?></td>
            <td><?php echo $booking['user_id']; ?></td>
            <td><?php echo $booking['start_date']; ?></td>
            <td><?php echo $booking['end_date']; ?></td>
            <td>
                <a href="?entity=booking&action=update&id=<?php echo $booking['id']; ?>">Edit</a> |
                <a href="?entity=booking&action=delete&id=<?php echo $booking['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>