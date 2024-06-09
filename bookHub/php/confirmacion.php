<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Libros</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Exo+2:ital,wght@0,100..900;1,100..900&family=Glegoo:wght@400;700&family=Gowun+Dodum&family=Graduate&display=swap" rel="stylesheet">
    <style>
        .confirmar-container {
            gap: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            justify-content: center;
            align-items: center;
            margin: auto;
            width: 80%;

        }
        .btn-custom {
            background-color: #BC07CB;
            color: white;
            border-radius: 15px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <a class="navbar-brand" href="../index.php">BookHub</a>
    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../libros.php">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contacto">Contacto</a>
            </li>
        </ul>
        <div class="search-bar">
            <input type="text" id="search-input" class="form-control" placeholder="Buscar libros">
        </div>
        <?php if(isset($_SESSION['nombre'])): ?>
            <span class="navbar-text"> <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            <a href="logout.php" class="btn btn-logout my-2 my-sm-0 ml-2" type="button">Log Out</a>
        <?php else: ?>
            <a href="../register.php" class="btn btn-register my-2 my-sm-0 ml-2" type="button">Register</a>
            <a href="../login.php" class="btn btn-login my-2 my-sm-0 ml-2" type="button">Log In</a>
        <?php endif; ?>
        <a href="view_cart.php" class="ml-2"><i class="fas fa-shopping-bag"></i></a>
    </div>
</nav>
<br><br><br><br><br><br>
<main>
    <div class="confirmar-container">
        <h1>Gracias por tu pedido</h1>
        <p>Tu pedido ha sido recibido y está siendo procesado.</p>
        <a href="../index.php" class="btn btn-custom">Volver al Inicio</a>
    </div>
</main>
<br><br><br><br><br><br>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4" id="p">
                <h5 id="contacto">CONTACTO:</h5>
                <p>Tel: (+34) 657342895</p>
                <p>Email: lapaginamagica@gmail.com</p>
                <br>
                <h5>HORARIO DE APERTURA:</h5>
                <p>Lunes a Viernes: 9:00 AM - 7:00 PM</p>
                <p>Sábado y Domingo: 10:00 AM - 5:00 PM</p>
            </div>
            <div class="col-md-4">
                <h5>VISÍTANOS EN:</h5>
                <p>1234 Calle de los Libros</p>
                <p>Ciudad Literario, CP 56789</p>
                <p>País de las Maravillas</p>
            </div>
            <div class="col-md-4">
                <div class="col-md-12 text-center social-icons">
                    <br>
                    <br>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/instagram-new.png" alt="Instagram"></a>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/twitter.png" alt="X"></a>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/facebook-new.png" alt="Facebook"></a>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>&copy; 2024 BookStore</p>
                </div>
            </div>
        </div>
    </div>
    </footer>
    <div class="back-to-top" id="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
