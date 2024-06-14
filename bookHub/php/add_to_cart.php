<?php
session_start(); // Inicia la sesión
require '../db.php';  // Archivo de conexión a la base de datos

// Verifica si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    //En caso de no estar logueado, redirige a iniciar
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Debes iniciar sesión para agregar libros al carrito.'
    ];
    header("Location: ../iniciar.php");
    exit();
}

$user_id = $_SESSION['user_id']; //Obtiene el ID del usuario desde la sesion

if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn']; //Obtiene lel ISBN del lbro desde el formulario

    try {
        // Verificar si el carrito del usuario ya existe
        $stmt = $pdo->prepare("SELECT ID_carrito FROM carrito WHERE ID_usuario = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $carrito = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$carrito) {
            // Crear un nuevo carrito para el usuario si no existe
            $stmt = $pdo->prepare("INSERT INTO carrito (ID_usuario) VALUES (:user_id)");
            $stmt->execute(['user_id' => $user_id]);
            $carrito_id = $pdo->lastInsertId(); //Obtienen el ID del carrito generado
        } else {
            $carrito_id = $carrito['ID_carrito']; //Usa el ID del carrito existente.
        }

        // Verificar el stock del libro
        $stmt = $pdo->prepare("SELECT Stock FROM libro WHERE ISBN = :isbn");
        $stmt->execute(['isbn' => $isbn]);
        $libro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$libro || $libro['Stock'] <= 0) {
            //Si el libro no exxiste o no tiene stock, muestra un mensaje  de error
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
            // Agregar el libro al carrito (sin modificar el stock aquí) agrgandolo con 1 en cantidad.
            $stmt = $pdo->prepare("INSERT INTO detalle_carrito (ID_carrito, ISBN, Titulo, Autor, Precio, Cantidad)
                                    SELECT :carrito_id, ISBN, Titulo, Autor, Precio, 1 FROM libro WHERE ISBN = :isbn");
            $stmt->execute(['carrito_id' => $carrito_id, 'isbn' => $isbn]);
        } else {
            // Si el libro ya esta en el carrito, incrementa la cantidad.
            $new_quantity = $detalle['Cantidad'] + 1;
            $stmt = $pdo->prepare("UPDATE detalle_carrito SET Cantidad = :new_quantity WHERE ID_carrito = :carrito_id AND ISBN = :isbn");
            $stmt->execute(['new_quantity' => $new_quantity, 'carrito_id' => $carrito_id, 'isbn' => $isbn]);
        }

        // Genera un mensaje de éxito o advertencia si el stock llega a 0
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
        // Esto maneja errores de la base de datos y muestra un mensaje de error
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => 'Error al agregar el libro al carrito: ' . $e->getMessage()
        ];
        header("Location: ../libros.php");
        exit();
    }
} else {
    // Si no hay un ISBN, da un mensaje de
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'ISBN no proporcionado.'
    ];
    header("Location: ../libros.php");
    exit();
}
?>
