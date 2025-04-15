<?php
// /var/www/html/hotel2/src/views/rate/list.php
$rates = $facade->getRates();

// Depuración temporal
// echo "<pre>Rates: ";
// var_dump($rates);
// echo "</pre>";
?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="material-icons align-middle">attach_money</i> Rates</h2>
    <a href="?entity=rate&action=create" class="btn btn-success mb-3"><i class="material-icons align-middle">add</i> Add New Rate</a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Room Code</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!is_array($rates) || count($rates) === 0): ?>
                <tr>
                    <td colspan="3" class="text-center">No rates found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($rates as $rate): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rate->roomCode ?? 'Sin código'); ?></td>
                        <td><?php echo htmlspecialchars($rate->price ?? 'Sin precio'); ?></td>
                        <td>
                            <a href="?entity=rate&action=update&id=<?php echo urlencode($rate->id ?? ''); ?>" class="btn btn-sm btn-primary"><i class="material-icons">edit</i> Edit</a>
                            <a href="?entity=rate&action=delete&id=<?php echo urlencode($rate->id ?? ''); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');"><i class="material-icons">delete</i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>