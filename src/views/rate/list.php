<?php
// /var/www/html/hotel/src/views/rate/list.php
$rates = $facade->getRates();
?>

<h2>Rates</h2>
<a href="?entity=rate&action=create">Add New Rate</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Room ID</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($rates as $rate): ?>
        <tr>
            <td><?php echo $rate->id; ?></td>
            <td><?php echo $rate->roomId; ?></td>
            <td><?php echo $rate->price; ?></td>
            <td>
                <a href="?entity=rate&action=update&id=<?php echo $rate->id; ?>">Edit</a> |
                <a href="?entity=rate&action=delete&id=<?php echo $rate->id; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>