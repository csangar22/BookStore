<?php
session_start();
require '../db.php';  // Archivo de conexión a la base de datos
$logged_in = isset($_SESSION['nombre']);
// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Debes iniciar sesión para ver tu carrito.'
    ];
    header("Location: ../iniciar.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Recuperar el ID del carrito
$stmt = $pdo->prepare("SELECT ID_carrito FROM carrito WHERE ID_usuario = :user_id");
$stmt->execute(['user_id' => $user_id]);
$carrito = $stmt->fetch(PDO::FETCH_ASSOC);

$libros = [];
$total = 0;

if ($carrito) {
    $carrito_id = $carrito['ID_carrito'];

    // Recuperar los detalles del carrito
    $stmt = $pdo->prepare("SELECT dc.ISBN, dc.Titulo, dc.Autor, dc.Precio, dc.Cantidad, l.Image 
                        FROM detalle_carrito dc 
                        JOIN libro l ON dc.ISBN = l.ISBN WHERE dc.ID_carrito = :carrito_id");
    $stmt->execute(['carrito_id' => $carrito_id]);
    $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($libros as $libro) {
        $total += $libro['Precio'] * $libro['Cantidad'];
    }
}
// Obtiene la cantidad de artículos en el carrito
function obtenerCantidadCarrito() {
    if (isset($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    } else {
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
        .pedido-container{
            display: flex;
            gap: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            justify-content: center;
            align-items: center;
            margin: auto;
            width: 50%;
        }
        .book-container {
            gap: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%; 
            
        }

        .book {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .book-image {
            margin-right: 10px;
        }

        .book-details {
            flex: 1;
        }

        .book-details h3, .book-details p {
            margin: 0;
        }

        .price {
            font-weight: bold;
            margin-top: 10px;
        }

        .btn {
            margin-top: 10px;
        }
        #delete{
            width: 100%;
        }
        .btn-logout{
            background-color: #dc70ed;
            border-radius: 10px;
            color: white;
        }
        .navbar-text{
            font-weight: bold;
            margin-right: 20px;

        }
        .search-bar {
            margin-right: 25px; 
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
            <?php if ($logged_in): ?>
            <span class="navbar-text"><?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                <a href="../logout.php" class="btn btn-logout my-2 my-sm-0 ml-2" type="button">Log Out</a>
            <?php else: ?>
                <a href="../registro.php" class="btn btn-register my-2 my-sm-0 ml-2" type="button">Register</a>
                <a href="../iniciar.php" class="btn btn-login my-2 my-sm-0 ml-2" type="button">Log In</a>
            <?php endif; ?>
            <a href="view_cart.php" class="ml-2">
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
    <main>
        <div class="pedido-container mt-5">
            <div id="message" class="alert d-none"></div>
            <div class="row">
                <div class="col-md-6">
                    <h2>Tu Pedido</h2>
                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="alert alert-<?php echo $_SESSION['message']['type']; ?>" role="alert">
                            <?php echo $_SESSION['message']['text']; ?>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>

                    <div id="carrito">
                        <?php
                        if (!empty($libros)) {
                            foreach ($libros as $libro) {
                                echo "<div class='book-container mb-3 p-3 border'>
                                        <div class='book d-flex align-items-center'>
                                            <div class='book-image mr-3'>
                                
                                                <img src='../{$libro['Image']}' alt='{$libro['Titulo']}' class='img-fluid' style='max-width: 120px;'>
                                            </div>
                                            <div class='book-details'>
                                                <h3>{$libro['Titulo']}</h3>
                                                <p>{$libro['Autor']}</p>
                                                <p class='price'>{$libro['Precio']} €</p>
                                                <p>Cantidad: {$libro['Cantidad']}</p>
                                                <form action='remove_from_cart.php' method='post'>
                                                    <input type='hidden' name='isbn' value='{$libro['ISBN']}'>
                                                    <button type='submit' class='btn btn-danger' id='delete'>Eliminar del Carrito</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>";
                            }
                        } else {
                            echo "<p>El carrito está vacío</p>";
                        }
                        ?>
                    </div>
                    <p>Total: <?php echo number_format($total, 2); ?> €</p>
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
    <script src="../js/scripts.js"></script>
    <script>
    function removeFromCart(isbn) {
        $.ajax({
            type: 'POST',
            url: 'remove_from_cart.php',
            data: { isbn: isbn },
            success: function(response) {
                $('#message').removeClass('d-none alert-danger alert-success');
                if (response === 'success') {
                    $('#message').addClass('alert-success').text('El libro ha sido eliminado del carrito.');
                    $('#book-' + isbn).remove();
                } else {
                    $('#message').addClass('alert-danger').text(response);
                }
            }
        });
    }
</script>
</body>
</html>