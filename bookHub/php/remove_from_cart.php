<?php
session_start();
require '../db.php';  // Archivo de conexión a la base de datos

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Debes iniciar sesión para modificar tu carrito.'
    ];
    header("Location: ../iniciar.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];

    // Recuperar el ID del carrito
    $stmt = $pdo->prepare("SELECT ID_carrito FROM carrito WHERE ID_usuario = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $carrito = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($carrito) {
        $carrito_id = $carrito['ID_carrito'];

        // Eliminar el libro del carrito
        $stmt = $pdo->prepare("DELETE FROM detalle_carrito WHERE ID_carrito = :carrito_id AND ISBN = :isbn");
        $stmt->execute(['carrito_id' => $carrito_id, 'isbn' => $isbn]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'El libro ha sido eliminado del carrito.'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => 'El libro no está en el carrito.'
            ];
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => 'No se pudo encontrar el carrito del usuario.'
        ];
    }
} else {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'ISBN no proporcionado.'
    ];
}

header("Location: view_cart.php");
exit();
?>
