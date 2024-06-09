<?php
include 'navbar.php';
?>
<main>
    <!--CONTENEDOR DE LIBROS-->
    <br>
    <br>
    <div class="book-container">
        <div class="row" id="book-list">
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
                    if(isset($_GET['message'])) {
                        $message = urldecode($_GET['message']);
                        echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
                    } elseif (!empty($message)) {
                        echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
                    }
                ?>
                <div class="row">
                    <div class="col-md-3 book">
                        <a href="book-details.php?isbn=9780063058501">
                            <img src="img/heartless-hunter-kristen-ciccarelli.jpg" alt="Heartless Hunter by Kristen Ciccarelli">
                        </a>
                        <h3>HEARTLESS HUNTER</h3>
                        <p>Kristen Ciccarelli</p>
                        <div class="stars">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                        </div>
                        <div class="price">18.90 €</div>
                        <form action="php/add_to_cart.php" method="post">
                            <input type="hidden" name="isbn" value="9780063058501">
                            <button type="submit" class="btn add-to-cart">Comprar</button>
                        </form>
                    </div>
                    <div class="col-md-3 book">
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
                        <div class="price">21.37 €</div>
                        <form action="php/add_to_cart.php" method="post">
                            <input type="hidden" name="isbn" value="9781635574091">
                            <button type="submit" class="btn add-to-cart">Comprar</button>
                        </form>
                    </div>
                    <div class="col-md-3 book">
                        <a href="book-details.php?isbn=9781982181183">
                            <img src="img/miss-morgans-book-brigade-janet-skeslien-charles.jpg" alt="Miss Morgan's Book Brigade by Janet Skeslien Charles">
                        </a>
                        <h3>Miss Morgan's Book Brigade</h3>
                        <p>Janet Skeslien Charles</p>
                        <div class="stars">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9734;</span>
                        </div>
                        <div class="price">22.70 €</div>
                        <form action="php/add_to_cart.php" method="post">
                            <input type="hidden" name="isbn" value="9781982181183">
                            <button type="submit" class="btn add-to-cart">Comprar</button>
                        </form>
                    </div>
                    <div class="col-md-3 book">
                        <a href="book-details.php?isbn=9780593239473">
                            <img src="img/the-demon-of-unrest-erik-larson.jpg" alt="The Demon of Unrest by Erik Larson">
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
                        <div class="price">20.65 €</div>
                        <form action="php/add_to_cart.php" method="post">
                            <input type="hidden" name="isbn" value="9780593239473">
                            <button type="submit" class="btn add-to-cart">Comprar</button>
                        </form>
                    </div>
                    <div class="col-md-3 book">
                        <a href="book-details.php?isbn=9780593336829">
                            <img src="img/bride-ali-hazelwood.jpg" alt="Bride by Ali Hazelwood">
                        </a>
                        <h3>Bride</h3>
                        <p>Ali Hazelwood</p>
                        <div class="stars">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9734;</span>
                        </div>
                        <div class="price">14.00 €</div>
                        <form action="php/add_to_cart.php" method="post">
                            <input type="hidden" name="isbn" value="9780593336829">
                            <button type="submit" class="btn add-to-cart">Comprar</button>
                        </form>
                    </div>
                </div>
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
