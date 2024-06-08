<?php
session_start();
include 'db.php';

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$codigo_postal = $_POST['codigo_postal'];
$total = 0;

// Calcular el total del pedido
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $isbn) {
        $libro = $libros[$isbn];
        $total += $libro['precio'];
    }
}

// Insertar el pedido en la tabla de pedidos
$stmt = $conn->prepare("INSERT INTO pedido (Nombre, Correo, Direccion, Ciudad, Codigo_postal, Total) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssd", $nombre, $correo, $direccion, $ciudad, $codigo_postal, $total);
$stmt->execute();
$pedido_id = $stmt->insert_id;
$stmt->close();

// Insertar los detalles del pedido en la tabla de detalles_pedido
if (!empty($_SESSION['cart'])) {
    $stmt = $conn->prepare("INSERT INTO detalle_pedido (Id_pedido, ISBN, Titulo, Autor, Precio) VALUES (?, ?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $isbn) {
        $libro = $libros[$isbn];
        $stmt->bind_param("isssd", $pedido_id, $isbn, $libro['titulo'], $libro['autor'], $libro['precio']);
        $stmt->execute();
    }
    $stmt->close();
}

// Limpiar el carrito
$_SESSION['cart'] = [];

// Cerrar la conexión
$conn->close();

// Redirigir a una página de confirmación
header("Location: confirmacion.php");
exit();
?>
