<?php
require 'db.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar los datos
    if (empty($email) || empty($password)) {
        die('Por favor, completa todos los campos.');
    }

    // Verificar las credenciales del usuario
    try {
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['Password'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $user['ID_usuario']; // Guardar el ID del usuario en la sesión
            $_SESSION['email'] = $email;
            $_SESSION['nombre'] = $user['Nombre'];
            header('Location: Index.php');
            exit();
        } else {
            $message = 'Credenciales incorrectas.';
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
