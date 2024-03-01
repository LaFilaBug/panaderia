document.addEventListener('DOMContentLoaded', function() {
    var closeButton = document.getElementById('close-btn');
    var errorContainer = document.getElementById('error-container');

    closeButton.addEventListener('click', function() {
        errorContainer.style.display = 'none'; // Oculta el contenedor de error
    });
});