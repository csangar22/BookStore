<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar los datos
    if (empty($email) || empty($password)) {
        die('Por favor, completa todos los campos.');
    }

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el usuario en la base de datos
    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (Nombre, Apellido ,Email, Password) VALUES (:name, :lastname ,:email, :password)");
        $stmt->execute(['name' => $name, 'lastname' => $lastname, 'email' => $email, 'password' => $hashed_password]);
        echo 'Usuario registrado exitosamente.';

        // Iniciar sesión
        $_SESSION['email'] = $email;
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo 'Este email ya está registrado.';
        } else {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>


