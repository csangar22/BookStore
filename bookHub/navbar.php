<?php
session_start();
require 'db.php';
$logged_in = isset($_SESSION['nombre']);

function obtenerCantidadCarrito() {
    global $pdo, $user_id;

    try {
        // Consulta para obtener la cantidad de artículos en el carrito
        $stmt = $pdo->prepare("SELECT COUNT(*) AS Cantidad FROM detalle_carrito dc JOIN carrito c ON dc.ID_carrito = c.ID_carrito WHERE c.ID_usuario = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['Cantidad'])) {
            return $result['Cantidad'];
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        // Manejo de errores
        return 0;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Libros</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Exo+2:ital,wght@0,100..900;1,100..900&family=Glegoo:wght@400;700&family=Gowun+Dodum&family=Graduate&display=swap" rel="stylesheet">
    <style>
        .btn-logout{
            background-color: #dc70ed;
            border-radius: 10px;
            color: white;
        }
        .navbar-text{
            font-weight: bold;
            margin-right: 20px;
        }
        .form-inline{
            margin-right: 17px;
        }
        
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <a class="navbar-brand" href="Index.php">BookHub</a>
    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="Index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="libros.php">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contacto">Contacto</a>
            </li>
        </ul>
        <!-- Formulario de búsqueda -->
        <form class="form-inline my-2 my-lg-0" method="GET" action="libros.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar libros" aria-label="Search" name="search" id="search-input">
        </form>
        <?php if ($logged_in): ?>
            <span class="navbar-text"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            <a href="logout.php" class="btn btn-logout my-2 my-sm-0 ml-2" type="button">Log Out</a>
        <?php else: ?>
            <a href="registro.php" class="btn btn-register my-2 my-sm-0 ml-2" type="button">Register</a>
            <a href="iniciar.php" class="btn btn-login my-2 my-sm-0 ml-2" type="button">Log In</a>
        <?php endif; ?>

        <!-- Mostrar el ícono de la cesta con la cantidad de artículos -->
        <a href="php/view_cart.php" class="ml-2">
            <i class="fas fa-shopping-bag"></i>
            <?php
            $cantidadCarrito = obtenerCantidadCarrito();
            if ($cantidadCarrito > 0) {
                echo '<span class="badge badge-danger">' . $cantidadCarrito . '</span>';
            }
            ?>
        </a>
    </div>
</nav>
