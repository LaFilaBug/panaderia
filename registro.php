<?php
include "includes/config/database.php";

$bd = conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['usuario'] && $_POST['nombre'] && $_POST['clave'] && $_POST['correo']) {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $correo = $_POST['correo'];

        $stmt = $bd->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_NUM);
        $count = $row[0];

        if ($count == 0) {   //Recuento de filas
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
            echo "El nombre de usuario ya está en uso. Por favor, elija otro.";
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

<body>
<<<<<<< HEAD
    <h1>Registro</h1>
    <form id="registerForm">
        <label for="regUsername">Nombre de usuario:</label><br>
        <input type="text" id="regUsername" name="regUsername" required><br>
        <label for="regPassword">Contraseña:</label><br>
        <input type="password" id="regPassword" name="regPassword" required><br>
        <input type="submit" value="Registrarse">
    </form>
    <a href="inicioSesion.php" class="IrAinicio">Ir a Inicio Sesion</a>
    <script src="../scripts/login.js"></script>
    <script src="./scripts/botonVolador.js"></script>
=======
<h1>REGISTRO</h1>
<form method='POST'>
    <label for='nombre'>Introduzca nombre:</label>
    <input type='text' name='nombre' placeholder='Nombre...' required><br>
    <label for='usuario'>Introduzca nombre usuario:</label>
    <input type='text' name='usuario' placeholder='Nombre de usuario...' required><br>
    <label for='clave'>Introduzca clave:</label>
    <input type='password' name='clave' placeholder='Contraseña...' required><br>
    <label for='correo'>Introduzca correo:</label>
    <input type='text' name='correo' placeholder='Introduzca correo...' required><br>
    <button type='submit'>Enviar</button>
</form>
<a href="inicioSesion.php">Inicie sesión aquí si ya tienes cuenta</a>
>>>>>>> 4c7593e9dfd261967dc0ee3644debf087b471c1e
</body>

</html>