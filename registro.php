<?php
require 'includes/config/database.php';

$bd = conectarDB();
$err = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['usuario'] && $_POST['nombre'] && $_POST['clave'] && $_POST['correo']) {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT); //Hasheo de la contraseña
        $correo = $_POST['correo'];
        $stmt = $bd->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        $count = $row[0];

        if ($count == 0) {   
            $rol = "usuario";
            $consulta = $bd->prepare("INSERT INTO usuarios (usuario, nombre, clave, correo) VALUES (?, ?, ?, ?)");
            $consulta->bind_param("ssss", $usuario, $nombre, $clave, $correo);

            if ($consulta->execute()) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["nombre"] = $nombre;
                header("Location: index.php");
            }
        } else {
            $err = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/stylesRegistro.css">
    <title>Registro del cliente</title>
</head>

<body class='bodyRegistro'>
    <?php if ($err): ?>
        <div id="error-container" class="error-container">
            <p class="incorrect">El nombre de usuario ya está en uso. Por favor, elija otro.</p>
            <span id="close-btn" class="close-btn">&times;</span>
        </div>
    <?php endif; ?>

    <form class="formRegistro" method='POST'>
        <h1 class="h1Registro">REGISTRO</h1>
        <label class="labelRegistro" for='nombre'>&#x1F464; Introduzca nombre:</label>
        <input class="inputRegistro" type='text' name='nombre' required><br>
        <label  class="labelRegistro"  for='usuario'>&#128100; Introduzca nombre usuario:</label>
        <input   class="inputRegistro" type='text' name='usuario' required><br>
        <label  class="labelRegistro" for='clave'>&#128274; Introduzca clave:</label>
        <input  class="inputRegistro" type='password' name='clave'  required><br>
        <label class="labelRegistro"  for='correo'>&#x1F4E7; Introduzca correo:</label>
        <input class="inputRegistro" type='text' name='correo'  required><br>

        <div class="containerRegistro">
            <button class="buttonRegistro" type='submit'>Enviar</button>
            <button class="buttonRegistro" onclick="location.href='./index.php'" > Volver</button>
        </div>

        <center>  <a href="inicioSesion.php" class="IrAinicio">Inicie sesión aquí si ya tienes cuenta</a> </center> 
    </form>

    <script>
        document.getElementById('close-btn').addEventListener('click', function() {
            document.getElementById('error-container').style.display = 'none';
        });
    </script>
</body>

</html>