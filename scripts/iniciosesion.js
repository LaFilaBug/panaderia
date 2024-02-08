document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    var storedPassword = localStorage.getItem(username);

    if(password === storedPassword) {
        alert('Inicio de sesión exitoso');
        // Aquí puedes redirigir al usuario a la página principal o a cualquier otra página
        window.location.href = '../index.html';
    } else {
        alert('Error en el inicio de sesión');
    }
});