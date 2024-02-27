document.querySelector('a').addEventListener('click', function(event) {
    event.preventDefault(); // Previene la acción predeterminada del enlace
    this.classList.add('moveUp'); // Agrega la clase 'moveUp' al enlace
    setTimeout(function() {
        window.location.href = 'inicioSesion.php'; // Redirige a la página principal
            }, 1000); // Espera 1 segundo (la duración de la animación) antes de redirigir
        });