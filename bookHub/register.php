<?php
session_start();
require 'db.php';

$message = '';

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
        $stmt = $pdo->prepare("INSERT INTO usuario (Nombre, Apellido, Email, Password) VALUES (:name, :lastname, :email, :password)");
        $stmt->execute(['name' => $name, 'lastname' => $lastname, 'email' => $email, 'password' => $hashed_password]);

        // Iniciar sesión
        $_SESSION['email'] = $email;

        $_SESSION['message'] = 'Usuario creado, por favor inicie sesión.';
        $_SESSION['message_type'] = 'alert-success'; // Mensaje de éxito
        header('Location: registro.php');
        exit();

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $_SESSION['message'] = 'Este email ya está registrado.';
            $_SESSION['message_type'] = 'alert-danger'; // Mensaje de error
        } else {
            $_SESSION['message'] = 'Error: ' . $e->getMessage();
            $_SESSION['message_type'] = 'alert-danger'; // Mensaje de error
        }
        header('Location: registro.php');
        exit();
    }
}
