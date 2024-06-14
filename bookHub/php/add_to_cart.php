<?php
session_start();
require '../db.php';  // Archivo de conexión a la base de datos

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Debes iniciar sesión para agregar libros al carrito.'
    ];
    header("Location: ../iniciar.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];

    try {
        // Verificar si el carrito del usuario ya existe
        $stmt = $pdo->prepare("SELECT ID_carrito FROM carrito WHERE ID_usuario = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $carrito = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$carrito) {
            // Crear un nuevo carrito si no existe
            $stmt = $pdo->prepare("INSERT INTO carrito (ID_usuario) VALUES (:user_id)");
            $stmt->execute(['user_id' => $user_id]);
            $carrito_id = $pdo->lastInsertId();
        } else {
            $carrito_id = $carrito['ID_carrito'];
        }

        // Verificar el stock del libro
        $stmt = $pdo->prepare("SELECT Stock FROM libro WHERE ISBN = :isbn");
        $stmt->execute(['isbn' => $isbn]);
        $libro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$libro || $libro['Stock'] <= 0) {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => 'El libro no está disponible en stock.'
            ];
            header("Location: ../libros.php");
            exit();
        }

        // Verificar si el libro ya está en el carrito
        $stmt = $pdo->prepare("SELECT * FROM detalle_carrito WHERE ID_carrito = :carrito_id AND ISBN = :isbn");
        $stmt->execute(['carrito_id' => $carrito_id, 'isbn' => $isbn]);
        $detalle = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$detalle) {
            // Agregar libro al carrito (sin modificar el stock aquí)
            $stmt = $pdo->prepare("INSERT INTO detalle_carrito (ID_carrito, ISBN, Titulo, Autor, Precio, Cantidad) 
                                    SELECT :carrito_id, ISBN, Titulo, Autor, Precio, 1 FROM libro WHERE ISBN = :isbn");
            $stmt->execute(['carrito_id' => $carrito_id, 'isbn' => $isbn]);
        } else {
            // Actualizar cantidad en el carrito
            $new_quantity = $detalle['Cantidad'] + 1;
            $stmt = $pdo->prepare("UPDATE detalle_carrito SET Cantidad = :new_quantity WHERE ID_carrito = :carrito_id AND ISBN = :isbn");
            $stmt->execute(['new_quantity' => $new_quantity, 'carrito_id' => $carrito_id, 'isbn' => $isbn]);
        }

        // Mensaje de éxito o advertencia si el stock llega a 0
        if ($libro['Stock'] - 1 <= 0) {
            $_SESSION['message'] = [
                'type' => 'warning',
                'text' => 'Libro agregado al carrito, pero ya no hay más stock disponible.'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Libro agregado al carrito.'
            ];
        }

        // Redirigir a la página de libros
        header("Location: ../libros.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => 'Error al agregar el libro al carrito: ' . $e->getMessage()
        ];
        header("Location: ../libros.php");
        exit();
    }
} else {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'ISBN no proporcionado.'
    ];
    header("Location: ../libros.php");
    exit();
}
?>
