<?php
$host = 'localhost';
$dbname = 'bookhub';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Lo sentimos, no se pudo conectar a la base de datos en este momento. Por favor, inténtelo de nuevo más tarde.";
}
?>