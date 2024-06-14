<?php
session_start();
$logged_in = isset($_SESSION['nombre']);
$message = '';
$message_type = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'alert-danger';
    unset($_SESSION['message']);
    unset($_SESSION['message_type']); // Eliminar el tipo de mensaje de la sesión después de mostrarlo
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
            <a href="php/view_cart.php" class="ml-2"><i class="fas fa-shopping-bag"></i></a>
        </div>
    </nav>

    </header>
    <main>
        <div class="signup-container">
        <?php
            if (!empty($message)) {
                echo '<div class="alert ' . $message_type . '" role="alert">' . $message . '</div>';
            }
        ?>
            <h2>Create an account</h2>
            <p>Enter your email to sign up for this app</p>
            <form id="signup-form" action="register.php" method="post">
                <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Apellido" required>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@domain.com" required>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

                <button type="submit" class="btn btn-primary btn-block">Sign up with email</button>
            </form>
            <div class="divider">or continue with</div>
                <button id="google-signup" class="google-btn">
                    <img src="img/google.png" alt="Google Logo">
                    Google
                </button><br>
                <p class="terms">By clicking continue, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></p>
            </div>

    </main>
    <!--Footer-->
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
                        <p>&copy; 2024 BookHub</p>
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
</body>
</html>
