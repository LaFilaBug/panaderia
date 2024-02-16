document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    let storedPassword = localStorage.getItem(username);

    if(password === storedPassword) {
        alert('Inicio de sesión exitoso');
        // Aquí puedes redirigir al usuario a la página principal o a cualquier otra página
        window.location.href = '../index.php';
    } else {
        alert('Error en el inicio de sesión');
    }
});