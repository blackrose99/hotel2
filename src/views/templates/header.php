<?php
// /var/www/html/hotel/src/views/templates/header.php
$facade = new HotelFacade();
$theme = $facade->getTheme('base');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hotel Management</title>
    <link rel="stylesheet" href="<?php echo $theme['css']; ?>">
</head>

<body>
    <header>
        <h1>Hotel Management</h1>
        <nav>
            <a href="/hotel/public/index.php">Home</a> |
            <a href="/hotel/src/views/room/list.php">Rooms</a> |
            <a href="/hotel/src/views/rate/list.php">Rates</a> |
            <a href="/hotel/src/views/booking/list.php">Bookings</a>
        </nav>
    </header>