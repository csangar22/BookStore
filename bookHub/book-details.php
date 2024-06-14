<?php
include 'navbar.php';
include 'db.php'; // Archivo para la conexión a la base de datos

$isbn = $_GET['isbn'];

$query = $pdo->prepare('SELECT * FROM libro WHERE isbn = ?');
$query->execute([$isbn]);
$book = $query->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    echo "Libro no encontrado";
    exit;
}

function getStarsHTML($stars) {
    $fullStars = floor($stars);                       // Número entero de estrellas llenas
    $decimalPart = $stars - $fullStars;               // Parte decimal para determinar fracción de estrella
    $halfStar = $decimalPart >= 0.25 && $decimalPart < 0.75 ? 1 : 0; // Determina si hay media estrella
    $emptyStars = 5 - $fullStars - $halfStar;         // Número de estrellas vacías necesarias

    $starsHTML = str_repeat('&#9733;', $fullStars);   // Genera las estrellas llenas (&#9733; es ★)

    // Agrega la media estrella visualmente
    if ($halfStar) {
        $starsHTML .= '<span style="position: relative; display: inline-block;">';
        $starsHTML .= '<span style="position: absolute; overflow: hidden; width: 50%;">';
        $starsHTML .= '&#9733;';  // Media estrella como una estrella llena
        $starsHTML .= '</span>';
        $starsHTML .= '<span style="position: absolute; overflow: hidden; width: 50%;">';
        $starsHTML .= '&#9734;';  // La otra mitad como una estrella vacía
        $starsHTML .= '</span>';
        $starsHTML .= '</span>';
    }

    $starsHTML .= str_repeat('&#9734;', $emptyStars); // Genera las estrellas vacías (&#9734; es ☆)

    return $starsHTML;                               // Devuelve el código HTML completo de estrellas
}
?>

<style>
    .btn-custom {
        background-color: #91009D;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 10px;
        margin-top: 10px;
        display: block;
        width: 70%;
    }
    .btn-custom:hover {
        background-color: #E06DEA;
    }
</style>
<main>
    <div class="container">
        <div class="book-containers" id="book-containers">
            <div class="row">
                <div class="col-md-3">
                    <img src="<?= $book['Image'] ?>" alt="Book Cover" class="book-image" id="book-image">
                </div>
                <div class="col-md-6">
                    <div class="book-title" id="book-title"><?= $book['Titulo'] ?></div>
                    <div class="book-author" id="book-author"><?= $book['Autor'] ?></div>
                    <div class="book-rating" id="book-rating"><?= getStarsHTML($book['Estrellas']) ?></div>
                    <div class="book-description" id="book-description">
                        <p id="book-description-text"><?= $book['Description'] ?></p>
                        <a href="#" style="color: red;">Ver más</a>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <div class="book-price" id="book-price"><?= $book['Precio'] ?> €</div>
                    <p class="book-iva">IVA Incluido</p>
                    <input type="hidden" name="isbn" id="isbn" value="<?= $book['ISBN'] ?>">
                    <button class="btn btn-custom mt-2" id="add-to-cart">Añadir a la cesta</button>
                </div>
            </div>
            <div class="book-details mt-3" id="book-details">
                <br><br>
                <h4 style="font-family: 'Graguate', serif; font-size: 20px"><strong>FICHA TECNICA</strong></h4>
                <br>
                <p><strong>Editorial:</strong> <?= $book['Editorial'] ?></p>
                <p><strong>Idioma:</strong> <?= $book['Idioma'] ?></p>
                <p><strong>Encuadernado:</strong> <?= $book['Encuadernado'] ?></p>
                <p><strong>ISBN:</strong> <?= $book['ISBN'] ?></p>
                <p><strong>Fecha de lanzamiento:</strong> <?= $book['Fecha_lanzamiento'] ?></p>
            </div>
            <button class="btn-review">Dejar mi opinión</button>
        </div>
        <div id="review-modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dejar mi opinión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="review-form" action="php/submit_review.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="isbn" id="isbn" value="<?= $book['ISBN'] ?>">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <input type="hidden" name="user_id" id="user-id" value="<?php echo $_SESSION['user_id']; ?>">
                                <div class="form-group">
                                    <label for="rating">Calificación:</label>
                                    <select id="rating" name="rating" class="form-control">
                                        <option value="5">★★★★★ - 5</option>
                                        <option value="4">★★★★☆ - 4</option>
                                        <option value="3">★★★☆☆ - 3</option>
                                        <option value="2">★★☆☆☆ - 2</option>
                                        <option value="1">★☆☆☆☆ - 1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="review">Comentario:</label>
                                    <textarea id="review" name="review" class="form-control" rows="3"></textarea>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning">Debe iniciar sesión para comentar.</div>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="js/scripts.js"></script>

<script>
$(document).ready(function() {
    $(".btn-review").click(function() {
        $("#review-modal").modal("show");
    });

    $("#review-form").submit(function(event) {
        event.preventDefault(); // Previene el envío del formulario estándar

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "php/submit_review.php",
            data: formData,
            success: function(response) {
                $("#review-modal").modal("hide");
                $("<div class='alert alert-success'>" + response + "</div>").insertAfter(".book-details").fadeOut(3000);
            },
            error: function() {
                $("<div class='alert alert-danger'>Error al enviar la reseña</div>").insertAfter(".book-details").fadeOut(3000);
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var addToCartBtn = document.getElementById('add-to-cart');
    addToCartBtn.addEventListener('click', function() {
        var isbn = document.getElementById('isbn').value;
        addToCart(isbn);
    });

    function addToCart(isbn) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = "Libro agregado a la cesta";
                alert(response);
                window.location.href = 'libros.php'; 
            }
        };
        xhr.send('isbn=' + isbn);
    }
});
</script>
</body>
</html>
