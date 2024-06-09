<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Libros</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Goblin+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Adamina&family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Exo+2:ital,wght@0,100..900;1,100..900&family=Glegoo:wght@400;700&family=Gowun+Dodum&family=Graduate&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
            <a class="navbar-brand" href="Index.php">BookHub</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="libros.php">Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-secondary btn-search my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <a href="registro.php" class="btn btn-register my-2 my-sm-0 ml-2" type="button">Register</button>
                <a href="iniciar.php" class="btn btn-login my-2 my-sm-0 ml-2" type="button">Log In</button>
                <a href="#" class="ml-2"><i class="fas fa-shopping-bag"></i></a>
            </div>
        </nav>
    </header>
    <main>
        <div class="signup-container">
            <?php
                if (!empty($message)) {
                    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
                }
            ?>
            <h2>Create an account</h2>
            <p>Enter your email to sign up for this app</p>
            <form id="signup-form" action="login.php" method="post">
                <input type="email" name="email" id="email" class="form-control" placeholder="email@domain.com" required>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

                <button type="submit" class="btn btn-primary btn-block">Sign up with email</button>
            </form>
            <div class="divider">or continue with</div>
            <button id="google-signup" class="google-btn">
                <img src="img/google.png" alt="Google Logo">
                Google
            </button><br>
            <p class="terms">By clicking continue, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></p>
          </div>
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
                        <p>&copy; 2024 BookHub</p>
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

    <!--<script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-app.js";
        import { getAuth, createUserWithEmailAndPassword, signInWithPopup, GoogleAuthProvider } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-auth.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.1/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
          apiKey: "AIzaSyCwSgQHa_HMZLgnypMKCeesyAXHm3k28YY",
          authDomain: "bookhub-1f085.firebaseapp.com",
          projectId: "bookhub-1f085",
          storageBucket: "bookhub-1f085.appspot.com",
          messagingSenderId: "734465330534",
          appId: "1:734465330534:web:e03d2380683d5046c0cca7",
          measurementId: "G-J87QXM017Y"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);

        // Sign up with email
        document.getElementById('signup-form').addEventListener('submit', function(event){
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            createUserWithEmailAndPassword(auth, email, password)
            //Se inicia sesion.
                .then((userCredential)=>{
                    const user = userCredential.user;
                    alert('Usuario creado con éxito.');
                    //Aquí se redirige a la interfaz de usuario.
                    window.location.href= "index.html"
                })
                .catch((error)=> {
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    alert(errorMessage);
                });
        });
        //Registro con google
        document.getElementById('google-signup').addEventListener('click', function(){
            const provider = new GoogleAuthProvider();
            signInWithPopup(auth, provider)
                .then((result) =>{
                    const user = result.user;
                    alert('Sesión iniciada con Google.')
                    //Aquí se redirige a la interfaz de usuario.
                    window.location.href= "index.html"
                })
                .catch((error)=> {
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    alert(errorMessage);
                });
        })
    </script>-->

</body>
</html>







