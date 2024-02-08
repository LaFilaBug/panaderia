document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('regUsername').value;
    var password = document.getElementById('regPassword').value;

    // Comprobar si el usuario ya existe
    if(localStorage.getItem(username)) {
        alert('El nombre de usuario ya existe');
        return;
    }

    localStorage.setItem(username, password);

    alert('Registro exitoso');
});