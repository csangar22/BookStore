<?php
$host = 'localhost';
$db   = 'bookhub';
$user = 'user';
$pass = 'user_password';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;db=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
