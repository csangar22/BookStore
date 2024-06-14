<?php
require '../db.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Debes iniciar sesión para procesar tu pedido.'
    ];
    header("Location: ../iniciar.php");
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

// Verificar si el carrito del usuario ya existe
$stmt = $pdo->prepare("SELECT ID_carrito FROM carrito WHERE ID_usuario = :user_id");
$stmt->execute(['user_id' => $id_usuario]);
$carrito = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$carrito) {
    die("El carrito está vacío.");
}

$carrito_id = $carrito['ID_carrito'];

// Obtener los detalles del carrito
$stmt = $pdo->prepare("SELECT dc.ISBN, l.Titulo, l.Autor, l.Precio, dc.Cantidad FROM detalle_carrito dc
                       JOIN libro l ON dc.ISBN = l.ISBN WHERE dc.ID_carrito = :carrito_id");
$stmt->execute(['carrito_id' => $carrito_id]);
$detalles_carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($detalles_carrito)) {
    die("El carrito está vacío.");
}

$total = 0;

// Calcular el total del pedido
foreach ($detalles_carrito as $detalle) {
    $total += $detalle['Precio'] * $detalle['Cantidad'];
}

// Insertar el pedido en la tabla de pedidos
$stmt = $pdo->prepare("INSERT INTO pedido (ID_usuario, Nombre, Correo, Direccion, Ciudad, Codigo_postal, Total) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$id_usuario, $nombre, $correo, $direccion, $ciudad, $codigo_postal, $total]);
$id_pedido = $pdo->lastInsertId();

// Insertar los detalles del pedido en la tabla de detalle_pedido
foreach ($detalles_carrito as $detalle) {
    $stmt = $pdo->prepare("INSERT INTO detalle_pedido (ID_pedido, ISBN, Titulo, Autor, Precio, Cantidad) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$id_pedido, $detalle['ISBN'], $detalle['Titulo'], $detalle['Autor'], $detalle['Precio'], $detalle['Cantidad']]);
    
    // Actualizar el stock del libro
    $stmt = $pdo->prepare("UPDATE libro SET Stock = Stock - ? WHERE ISBN = ?");
    $stmt->execute([$detalle['Cantidad'], $detalle['ISBN']]);
}

// Limpiar el carrito
$stmt = $pdo->prepare("DELETE FROM detalle_carrito WHERE ID_carrito = ?");
$stmt->execute([$carrito_id]);

$stmt = $pdo->prepare("DELETE FROM carrito WHERE ID_carrito = ?");
$stmt->execute([$carrito_id]);

// Redirigir a una página de confirmación

header("Location: confirmacion.php");
exit();
?>
