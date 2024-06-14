
// Inicializa el carrusel con autoplay
$(document).ready(function() {
    $('#carouselExampleSlidesOnly').carousel({
        interval: 5000, // Cambia el número para controlar el intervalo de cambio de imagen
        pause: false
    });
});

//Funcion de scroll
window.onscroll = function() {
    var backToTop = document.getElementById("back-to-top");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTop.style.display = "block";
    } else {
        backToTop.style.display = "none";
    }
  };
// Desplaza al inicio de la página cuando se hace clic en el botón de "back to top"
document.getElementById("back-to-top").onclick = function() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
};



