<?php
require '../db.php'; //Archivo de conexión de
session_start();

// Verifica si la solicitud es Post y si el usuario está autenticado.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $isbn = $_POST['isbn'];
    $userId = $_POST['user_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    try {
        // Prepara la consulta SQL para insertar en la tabla de reseña
        $stmt = $pdo->prepare("INSERT INTO resena (ID_libro, ID_usuario, Calificacion, Contenido) VALUES (?, ?, ?, ?)");
        $stmt->execute([$isbn, $userId, $rating, $review]);// Ejecutar la consulta con los datos del formulario

        echo "Reseña enviada correctamente"; // Mensaje de confirmación en caso de éxito
    } catch (PDOException $e) {
        echo "Error al enviar la reseña: " . $e->getMessage(); // Mensaje de error en caso de excepción
    }
}
?>
