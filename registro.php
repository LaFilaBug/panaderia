<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Registro</title>
    <link rel="stylesheet" href="styles/stylesRegistro.css">
</head>
<body>
    <h1>Registro</h1>
    <form id="registerForm">
        <label for="regUsername">Nombre de usuario:</label><br>
        <input type="text" id="regUsername" name="regUsername" required><br>
        <label for="regPassword">Contraseña:</label><br>
        <input type="password" id="regPassword" name="regPassword" required><br>
        <input type="submit" value="Registrarse">
    </form>
    <a href="inicioSesion.php">Ir a Inicio Sesion</a>
    <script src="../scripts/login.js"></script>
    <script>
    document.querySelector('a').addEventListener('click', function(event) {
    event.preventDefault(); // Previene la acción predeterminada del enlace
    this.classList.add('moveUp'); // Agrega la clase 'moveUp' al enlace
    setTimeout(function() {
        window.location.href = 'inicioSesion.php'; // Redirige a la página principal
            }, 1000); // Espera 1 segundo (la duración de la animación) antes de redirigir
        });
</script>
</body>
</html>