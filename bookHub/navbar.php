<?php
session_start();
$logged_in = isset($_SESSION['nombre']);
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
        <div class="search-bar">
            <input type="text" id="search-input" class="form-control" placeholder="Buscar libros">
        </div>
        <?php if(isset($_SESSION['nombre'])): ?>
            <span class="navbar-text">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            <a href="logout.php" class="btn btn-logout my-2 my-sm-0 ml-2" type="button">Log Out</a>
        <?php else: ?>
            <a href="register.html" class="btn btn-register my-2 my-sm-0 ml-2" type="button">Register</a>
            <a href="login.html" class="btn btn-login my-2 my-sm-0 ml-2" type="button">Log In</a>
        <?php endif; ?>
        <a href="php/view_cart.php" class="ml-2"><i class="fas fa-shopping-bag"></i></a>
    </div>
</nav>
