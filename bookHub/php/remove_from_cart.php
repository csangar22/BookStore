<?php
session_start();

if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
    if (($key = array_search($isbn, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-indexar el array
        header("Location: ../view_cart.php");
    } else {
        header("Location: ../view_cart.php?success=false&message=El+libro+no+está+en+el+carrito");
    }
} else {
    header("Location: ../view_cart.php?success=false&message=ISBN+no+proporcionado");
}
?>
