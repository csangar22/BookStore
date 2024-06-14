<?php
$host = 'db'; //Nombre del host de la base de datox (Contenedor Docker)
$dbname = 'bookhub'; //Nomnre de la base de datos
$user = 'user'; //Nombre de usuario de la base de datos
$pass = 'user_password'; //Contraseña del usuario

try {
    // Se crea una nueva instancia PDO para la conexión a ala base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // Se configura PDO para lanzar excepciones en caso de errores.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Captura cualquier excepcion de conexion y muestra un mensaje de error.
    die("Could not connect to the database: " . $e->getMessage());
}
?>
