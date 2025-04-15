<?php
// /var/www/html/hotel2/src/views/booking/list.php
$bookings = $facade->getBookings();

// Depuración temporal (descomentar si necesitas inspeccionar)
// echo "<pre>Bookings: ";
// var_dump($bookings);
// echo "</pre>";
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">book</i> Bookings</h2>
    <a href="?entity=booking&action=create" class="btn btn-success mb-3"><i class="material-icons align-middle">add</i> Add New Booking</a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>User Document</th>
                <th>Room Code</th>
                <th>Rate ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!is_array($bookings) || count($bookings) === 0): ?>
                <tr>
                    <td colspan="6" class="text-center">No bookings found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking->userDocumentId ?? 'Sin usuario'); ?></td>
                        <td><?php echo htmlspecialchars($booking->roomCode ?? 'Sin habitación'); ?></td>
                        <td><?php echo htmlspecialchars($booking->rateId ?? 'Sin tarifa'); ?></td>
                        <td><?php echo htmlspecialchars($booking->startDate ?? 'Sin fecha'); ?></td>
                        <td><?php echo htmlspecialchars($booking->endDate ?? 'Sin fecha'); ?></td>
                        <td>
                            <a href="?entity=booking&action=update&id=<?php echo urlencode($booking->id ?? ''); ?>" class="btn btn-sm btn-primary"><i class="material-icons">edit</i> Edit</a>
                            <a href="?entity=booking&action=delete&id=<?php echo urlencode($booking->id ?? ''); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');"><i class="material-icons">delete</i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>