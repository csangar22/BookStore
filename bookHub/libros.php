<?php
include 'navbar.php';
include 'db.php';
?>
<main>
    <!--CONTENEDOR DE LIBROS-->
    <br>
    <br>
    <div class="book-container">
        <div class="row">
            <div class="col-md-3" id="cat_id">
                <!--CATEGORIAS-->
                <h3>Categorías</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Ficción</a></li>
                    <li><a href="#">No ficción</a></li>
                    <li><a href="#">Infantil</a></li>
                    <li><a href="#">Ciencia ficción</a></li>
                    <li><a href="#">Fantasía</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-' . $_SESSION['message']['type'] . '" role="alert">' . $_SESSION['message']['text'] . '</div>';
                    unset($_SESSION['message']);
                }

                $search = isset($_GET['search']) ? $_GET['search'] : '';
                if ($search) {
                    $stmt = $pdo->prepare('SELECT * FROM libro WHERE Titulo LIKE ? OR Autor LIKE ?');
                    $stmt->execute(["%$search%", "%$search%"]);
                } else {
                    $stmt = $pdo->query('SELECT * FROM libro');
                }
                $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
                function getStarsHTML($stars) {
                    $fullStars = floor($stars);                       // Número entero de estrellas llenas
                    $decimalPart = $stars - $fullStars;               // Parte decimal para determinar fracción de estrella
                    $halfStar = $decimalPart >= 0.25 && $decimalPart < 0.75 ? 1 : 0; // Determina si hay media estrella
                    $emptyStars = 5 - $fullStars - $halfStar;         // Número de estrellas vacías necesarias

                    // Estilo CSS para las estrellas (amarillo)
                    $starStyle = 'style="color: gold;"';

                    $starsHTML = '<div class="stars" ' . $starStyle . '>';  // Inicia contenedor de estrellas
                    $starsHTML .= str_repeat('&#9733;', $fullStars);   // Estrellas llenas (&#9733; es ★)

                    // Agrega la media estrella visualmente
                    if ($halfStar) {
                        $starsHTML .= '<span ' . $starStyle . '>&#9733;</span>';  // Media estrella como una estrella llena
                        $starsHTML .= '<span ' . $starStyle . '>&#9734;</span>';  // La otra mitad como una estrella vacía
                    }

                    $starsHTML .= str_repeat('&#9734;', $emptyStars); // Estrellas vacías (&#9734; es ☆)
                    $starsHTML .= '</div>';                          // Cierra contenedor de estrellas

                    return $starsHTML;                               // Devuelve el código HTML completo de estrellas
                }


                // Código para imprimir libros
                echo '<div class="row">';
                foreach ($books as $book) {
                    echo '<div class="col-md-3 book">';
                    echo '<a href="book-details.php?isbn=' . $book['ISBN'] . '">';
                    echo '<img src="' . $book['Image'] . '" alt="' . $book['Titulo'] . '" class="img-fluid">';
                    echo '</a>';
                    echo '<h3>' . $book['Titulo'] . '</h3>';
                    echo '<p>' . $book['Autor'] . '</p>';

                    // Llama a la función getStarsHTML para imprimir las estrellas
                    echo getStarsHTML($book['Estrellas']);

                    echo '<div class="price">' . $book['Precio'] . ' €</div>';

                    // Verifica el stock para deshabilitar el botón si es necesario
                    if ($book['Stock'] <= 0) {
                        echo '<button type="button" class="btn add-to-cart" disabled>Agotado</button>';
                    } else {
                        echo '<form action="php/add_to_cart.php" method="post">';
                        echo '<input type="hidden" name="isbn" value="' . $book['ISBN'] . '">';
                        echo '<button type="submit" class="btn add-to-cart">Comprar</button>';
                        echo '</form>';
                    }

                    echo '</div>';
                }
                echo '</div>';
                ?>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
</main>
<!--FOOTER-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4" id="p">
                <h5 id="contacto">CONTACTO:</h5>
                <p>Tel: (+34) 657342895</p>
                <p>Email: lapaginamagica@gmail.com</p>
                <br>
                <h5>HORARIO DE APERTURA:</h5>
                <p>Lunes a Viernes: 9:00 AM - 7:00 PM</p>
                <p>Sábado y Domingo: 10:00 AM - 5:00 PM</p>
            </div>
            <div class="col-md-4">
                <h5>VISÍTANOS EN:</h5>
                <p>1234 Calle de los Libros</p>
                <p>Ciudad Literario, CP 56789</p>
                <p>País de las Maravillas</p>
            </div>
            <div class="col-md-4">
                <div class="col-md-12 text-center social-icons">
                    <br>
                    <br>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/instagram-new.png" alt="Instagram"></a>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/twitter.png" alt="X"></a>
                    <a href="#"><img src="https://img.icons8.com/ios-glyphs/30/ffffff/facebook-new.png" alt="Facebook"></a>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>&copy; 2024 BookStore</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="back-to-top" id="back-to-top">
    <i class="fas fa-arrow-up"></i>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="js/scripts.js"></script>
<script src="js/books.js"></script>
</body>
</html>
