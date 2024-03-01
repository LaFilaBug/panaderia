<?php
 require 'includes/config/database.php';

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

<form method='POST'>
    <h1>REGISTRO</h1>
    <label for='nombre'>&#x1F464; Introduzca nombre:</label>
    <input type='text' name='nombre' required><br>
    <label for='usuario'>&#128100; Introduzca nombre usuario:</label>
    <input type='text' name='usuario' required><br>
    <label for='clave'>&#128274; Introduzca clave:</label>
    <input type='password' name='clave'  required><br>
    <label for='correo'>&#x1F4E7; Introduzca correo:</label>
    <input type='text' name='correo'  required><br>

    <div class="container">

        <button class="button" type='submit'>Enviar</button>

        <button class="button" onclick="location.href='./index.php'" > Volver</button>

    </div>

    <center>  <a href="inicioSesion.php" class="IrAinicio">Inicie sesión aquí si ya tienes cuenta</a> </center> 
    

</form>
</body>

</html>