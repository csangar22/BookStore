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
                <a href="../logout.php" class="btn btn-logout my-2 my-sm-0 ml-2" type="button">Log Out</a>
            <?php else: ?>
                <a href="../registro.php" class="btn btn-register my-2 my-sm-0 ml-2" type="button">Register</a>
                <a href="../iniciar.php" class="btn btn-login my-2 my-sm-0 ml-2" type="button">Log In</a>
            <?php endif; ?>
            <a href="php/view_cart.php" class="ml-2"><i class="fas fa-shopping-bag"></i></a>
        </div>
    </nav>
    <main>
        <div class="container mt-5 pedido-container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Tu Pedido</h2>
                    <form action="procesar_pedido.php" method="post">
                        <div id="carrito">
                            <?php
                            $libros = [
                                "9780063058501" => ['titulo' => 'Heartless Hunter', 'autor' => 'Kristen Ciccarelli', 'precio' => 18.90, 'imagen' => '../img/heartless-hunter-kristen-ciccarelli.jpg'],
                                "9781635574091" => ['titulo' => 'House of Flame and Shadow', 'autor' => 'Sarah J. Maas', 'precio' => 21.37, 'imagen' => '../img/house-of-flame-and-shadow-sarah-j-maas.jpg'],
                                "9781982181183" => ['titulo' => 'Miss Morgan\'s Book Brigade', 'autor' => 'Janet Skeslien Charles', 'precio' => 22.70, 'imagen' => '../img/miss-morgans-book-brigade-janet-skeslien-charles.jpg'],
                                "9780593239473" => ['titulo' => 'The Demon of Unrest', 'autor' => 'Erik Larson', 'precio' => 20.65, 'imagen' => '../img/the-demon-of-unrest-erik-larson.jpg'],
                                "9780593336829" => ['titulo' => 'Bride', 'autor' => 'Ali Hazelwood', 'precio' => 14.00, 'imagen' => '../img/bride-ali-hazelwood.jpg'],
                            ];

                            $total = 0;

                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $isbn) {
                                    $libro = $libros[$isbn];
                                    echo "<div class='book-container mb-3 p-3 border'>
                                            <div class='book d-flex align-items-center'>
                                                <div class='book-image mr-3'>
                                                    <img src='{$libro['imagen']}' alt='{$libro['titulo']}' class='img-fluid' style='max-width: 100px;'>
                                                </div>
                                                <div class='book-details'>
                                                    <h3>{$libro['titulo']}</h3>
                                                    <p>{$libro['autor']}</p>
                                                    <p class='price'>{$libro['precio']} €</p>
                                                    <form action='remove_from_cart.php' method='post'>
                                                        <input type='hidden' name='isbn' value='$isbn'>
                                                        <button type='submit' class='btn btn-danger'>Eliminar del Carrito</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>";
                                    $total += $libro['precio'];
                                }
                            } else {
                                echo "<p>El carrito está vacío</p>";
                            }
                            ?>
                        </div>
                        <p>Total: <?php echo number_format($total, 2); ?> €</p>
                    </form>
                </div>
                <div class="col-md-6">
                    <h2>Información del Cliente</h2>
                    <form action="procesar_pedido.php" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo Electrónico:</label>
                            <input type="email" id="correo" name="correo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" id="ciudad" name="ciudad" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="codigo_postal">Código Postal:</label>
                            <input type="text" id="codigo_postal" name="codigo_postal" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Enviar Pedido</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!--FOOTER-->
    <footer class="footer mt-5">
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
            <div class="col-md-4 text-center">
                <div class="social-icons">
                    <br>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/instagram-new.png" alt="Instagram"></a>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/twitter.png" alt="X"></a>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/facebook-new.png" alt="Facebook"></a>
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
    <script src="js/scripts.js"></script>
    <script src="js/books.js"></script>
    <script src="../js/scripts.js"></script>
</body>
</html>
