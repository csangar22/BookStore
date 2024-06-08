<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar los datos
    if (empty($email) || empty($password)) {
        die('Por favor, completa todos los campos.');
    }

    // Verificar las credenciales del usuario
    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE Email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['Password'])) {
        // Iniciar sesión
        $_SESSION['email'] = $email;
        $_SESSION['nombre'] = $user['Nombre'];
        header('Location: index.php');
        exit();
    } else {
        echo 'Credenciales incorrectas.';
    }
}
?>

