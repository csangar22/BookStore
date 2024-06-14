<?php
require '../db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $isbn = $_POST['isbn'];
    $userId = $_POST['user_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    try {
        // Preparar la consulta SQL
        $stmt = $pdo->prepare("INSERT INTO resena (ID_libro, ID_usuario, Calificacion, Contenido) VALUES (?, ?, ?, ?)");
        $stmt->execute([$isbn, $userId, $rating, $review]);

        echo "Reseña enviada correctamente";
    } catch (PDOException $e) {
        echo "Error al enviar la reseña: " . $e->getMessage();
    }
}
?>
