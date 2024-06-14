<?php
session_start(); //Inicia la sesion
require '../db.php';  // Archivo de conexión a la base de datos

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    //Redirige al usuario a la página de inicio de sesión si no ha iniciado sesión
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Debes iniciar sesión para modificar tu carrito.'
    ];
    header("Location: ../iniciar.php");
    exit();
}

$user_id = $_SESSION['user_id']; //Obtener el ID del usuario de la sesion

//Verifica si se proporciona un ISBN
if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];// Obtiene el ISBN del libro desde el formulario

    // Recuperar el ID del carrito
    $stmt = $pdo->prepare("SELECT ID_carrito FROM carrito WHERE ID_usuario = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $carrito = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($carrito) {
        $carrito_id = $carrito['ID_carrito'];// Obtiene el ID del carrito

        // Elimina el libro del carrito
        $stmt = $pdo->prepare("DELETE FROM detalle_carrito WHERE ID_carrito = :carrito_id AND ISBN = :isbn");
        $stmt->execute(['carrito_id' => $carrito_id, 'isbn' => $isbn]);

        if ($stmt->rowCount() > 0) {
            //Mensaje de éxito si el libro fue eliminado.
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'El libro ha sido eliminado del carrito.'
            ];
        } else {
            //Mensaje de error si el libro no está en el carrito
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => 'El libro no está en el carrito.'
            ];
        }
    } else {
        // Mensaje de error si no se encuentra el carrito del usuario
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => 'No se pudo encontrar el carrito del usuario.'
        ];
    }
} else {
    // Mensaje de error si no se proporciona el ISBN
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'ISBN no proporcionado.'
    ];
}
//Redirige a la página del carrito
header("Location: view_cart.php");
exit();
?>
