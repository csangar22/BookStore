<?php
include 'navbar.php';
include 'db.php';
?>
    <main>
        <!--Imagen de inicio y titulo-->
        <div class="hero-section">
            <div class="overlay">
                <h1>Welcome to <span>BookHub</span></h1>
                <p>Explora historias que despiertan la imaginación<br> y transforman las vidas</p>
            </div>
        </div>
        <br>
        <br>
        <!--Carrusel-->
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/novedades_septiembre.png" class="d-block w-40" alt="Novedades Septiembre">
                </div>
                <div class="carousel-item">
                    <img src="img/novedades_2024.gif" class="d-block w-40" alt="Novedades 2024">
                </div>
                <div class="carousel-item">
                    <img src="img/isabel_allende.png" class="d-block w-40" alt="Mujeres del alma mía - Isabel Allende">
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            if ($search) {
                $stmt = $pdo->prepare('SELECT * FROM libro WHERE Titulo LIKE ? OR Autor LIKE ?');
                $stmt->execute(["%$search%", "%$search%"]);
            } else {
                $stmt = $pdo->query('SELECT * FROM libro');
            }
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!--Contenedor de libros-->
        <div class="book-container">
            <div class="book" data-title="THE DEMON OF UNREST" data-author="Erik Larson">
                <a href="book-details.php?isbn=9780593239473">
                    <img src="img/the-demon-of-unrest-erik-larson.jpg" alt="The demon of unrest by Erik Larson">
                </a>
                <h3>THE DEMON OF UNREST</h3>
                <p>Erik Larson</p>
                <div class="stars">
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9734;</span>
                </div>
            </div>
            <div class="book" data-title="HEARTLESS HUNTER" data-author="Kristen Ciccarelli">
                <a href="book-details.php?isbn=9780063058501">
                    <img src="img/heartless-hunter-kristen-ciccarelli.jpg" alt="Heartless Hunter by Kristen Ciccarelli">
                </a>
                <h3>HEARTLESS HUNTER</h3>
                <p>Kristen Ciccarelli</p>
                <div class="stars">
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#189;</span>
                    <span>&#9734;</span>
                </div>
            </div>
            <div class="book" data-title="House of Flame and Shadow" data-author="Sarah J. Maas">
                <a href="book-details.php?isbn=9781635574091">
                    <img src="img/house-of-flame-and-shadow-sarah-j-maas.jpg" alt="House of Flame and Shadow by Sarah J. Maas">
                </a>
                <h3>HOUSE OF FLAME AND SHADOW</h3>
                <p>Sarah J. Maas</p>
                <div class="stars">
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#9733;</span>
                    <span>&#189;</span>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </main>
    <!--Footer-->
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
