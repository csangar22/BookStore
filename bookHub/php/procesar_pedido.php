<?php
require '../db.php';


session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();
}

// Obtener el ID de usuario de la sesión
$id_usuario = $_SESSION['user_id'];

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$codigo_postal = $_POST['codigo_postal'];
$total = 0;

// Comprobar si el carrito está vacío
if (empty($_SESSION['cart'])) {
    die("El carrito está vacío.");
}

// Calcular el total del pedido
foreach ($_SESSION['cart'] as $isbn) {
    $stmt = $pdo->prepare("SELECT Precio FROM libro WHERE ISBN = ?");
    $stmt->execute([$isbn]);
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($libro) {
        $total += $libro['Precio'];
    } else {
        die("El libro con ISBN $isbn no existe.");
    }
}

// Insertar el pedido en la tabla de pedidos
$stmt = $pdo->prepare("INSERT INTO pedido (ID_usuario, Nombre, Correo, Direccion, Ciudad, Codigo_postal, Total) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$id_usuario, $nombre, $correo, $direccion, $ciudad, $codigo_postal, $total]);
$id_pedido = $pdo->lastInsertId();

// Insertar los detalles del pedido en la tabla de detalle_pedido
foreach ($_SESSION['cart'] as $isbn) {
    $stmt = $pdo->prepare("SELECT Titulo, Autor, Precio FROM libro WHERE ISBN = ?");
    $stmt->execute([$isbn]);
    $libro = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($libro) {
        $titulo = $libro['Titulo'];
        $autor = $libro['Autor'];
        $precio = $libro['Precio'];
        $stmt = $pdo->prepare("INSERT INTO detalle_pedido (ID_pedido, ISBN, Titulo, Autor, Precio, Cantidad) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_pedido, $isbn, $titulo, $autor, $precio, 1]); // Por ahora asumimos que la cantidad es 1
    } else {
        die("El libro con ISBN $isbn no existe.");
    }
}

// Limpiar el carrito
unset($_SESSION['cart']);

// Redirigir a una página de confirmación
header("Location: confirmacion.php");
exit();
?>
