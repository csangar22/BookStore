<?php

include 'navbar.php';
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
        .btn-custom:hover{
            background-color: #E06DEA;
        }
    </style>
    <main>
        <div class="container">
            <div class="book-containers" id="book-containers">
                <div class="row">
                    <div class="col-md-3">
                        <img src="" alt="Book Cover" class="book-image" id="book-image">
                    </div>
                    <div class="col-md-6">
                        <div class="book-title" id="book-title"></div>
                        <div class="book-author" id="book-author"></div>
                        <div class="book-rating" id="book-rating"></div>
                        <div class="book-description" id="book-description">
                            <p id="book-description-text"></p>
                            <a href="#" style="color: red;">Ver más</a>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">
                        <div class="book-price" id="book-price"></div>
                        <p class="book-iva">IVA Incluido</p>
                        <input type="hidden" name="isbn" value="">
                        <button class="btn btn-custom mt-2"
                            id="add-to-cart">Añadir a la cesta</button>
                    </div>
                </div>
                <div class="book-details mt-3" id="book-details"></div>
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
                      <form action="php/submit_review.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="isbn" id="isbn">
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
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/books.js"></script>

    <script>
    $(document).ready(function() {
        const urls = new URLSearchParams(window.location.search);
        const isbn = urls.get('isbn');

        const book = libros.find(libro => libro.isbn === isbn);

        if (book) {
            $('#book-title').text(book.title);
            $('#book-author').text(book.author);
            $('#book-rating').html(getStarsHTML(book.stars));
            $('#book-price').text(`${book.price} €`);
            $('#book-image').attr('src', book.image);
            $('#book-image').attr('alt', book.title);
            $('#book-description-text').text(book.description);

            $('#book-details').html(`
                <br><br>
                <h4 style="font-family: 'Graguate', serif; font-size: 20px"><strong>FICHA TECNICA</strong></h4>
                <br>
                <p><strong>Editorial:</strong> ${book.editorial}</p>
                <p><strong>Idioma:</strong> ${book.language}</p>
                <p><strong>Encuadernado:</strong> ${book.binding}</p>
                <p><strong>ISBN:</strong> ${book.isbn}</p>
                <p><strong>Fecha de lanzamiento:</strong> ${book.releaseDate}</p>
            `);

            $('#isbn').val(book.isbn);
        }

        function getStarsHTML(stars) {
            const fullStars = Math.floor(stars);
            const halfStar = stars % 1 !== 0;
            let starsHTML = '';

            for (let i = 0; i < fullStars; i++) {
                starsHTML += '&#9733;'; // Full star
            }
            if (halfStar) {
                starsHTML += '&#189;'; // Half star
            }
            for (let i = fullStars + halfStar; i < 5; i++) {
                starsHTML += '&#9734;'; // Empty star
            }
            return starsHTML;
        }

        $(".btn-review").click(function() {
            $("#review-modal").modal("show");
        });
    });
    </script>

</body>
</html>