<?php
// /var/www/html/hotel2/src/views/layout.php
require_once __DIR__ . '/../patterns/facade/HotelFacade.php';
require_once __DIR__ . '/../patterns/facade/UserFacade.php';

// Inicializamos los facades
$facade = new HotelFacade();
$userFacade = new UserFacade();

// Variables para controlar la vista
$entity = $_GET['entity'] ?? 'room';
$action = $_GET['action'] ?? 'list';
$error = null;

// Tema dinámico desde Abstract Factory
$theme = $facade->getTheme('base');

// Intentamos cargar el contenido dinámico
try {
    $viewFile = __DIR__ . "/{$entity}/{$action}.php";
    if (!file_exists($viewFile)) {
        throw new Exception("Vista no encontrada: $viewFile");
    }
} catch (Exception $e) {
    $error = "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hotel Management - <?php echo ucfirst($entity) . " " . ucfirst($action); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?php echo $theme['css']; ?>">
    <style>
        body {
            background-image: url('/hotel2/public/assets/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            padding-bottom: 60px;
        }

        header,
        .footer {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
        }

        main {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            margin: 20px auto;
            max-width: 1200px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="text-center">
        <h1>Hotel Management</h1>
        <nav class="nav justify-content-center">
            <a class="nav-link" href="?entity=room&action=list"><i class="material-icons">hotel</i> Rooms</a>
            <a class="nav-link" href="?entity=rate&action=list"><i class="material-icons">attach_money</i> Rates</a>
            <a class="nav-link" href="?entity=booking&action=list"><i class="material-icons">book</i> Bookings</a>
            <a class="nav-link" href="?entity=user&action=list"><i class="material-icons">person</i> Users</a>
        </nav>
    </header>

    <!-- Contenido dinámico -->
    <main>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php else: ?>
            <?php
            try {
                require_once $viewFile;
            } catch (Exception $e) {
                echo "<div class='alert alert-danger' role='alert'>Error al cargar la vista: " . $e->getMessage() . "</div>";
            }
            ?>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php require_once __DIR__ . '/templates/footer.php'; ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- main.js -->
    <script src="<?php echo $theme['js']; ?>"></script>
</body>

</html>