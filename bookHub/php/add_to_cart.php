<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];

    if (!in_array($isbn, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $isbn;
        header("Location: ../libros.php?success=true");
    } else {
        header("Location: ../libros.php?success=false&message=El+libro+ya+está+en+el+carrito");
    }
} else {
    header("Location: ../libros.php?success=false&message=ISBN+no+proporcionado");
}
?>
