<?php
     require 'includes/config/database.php';

    function comprobar_usuario($usuario, $clave) {
        $bd = conectarDB();
        $consulta = $bd->prepare("SELECT * FROM usuarios WHERE usuario = ? AND clave = ?");
        $consulta->bind_param("ss", $usuario, $clave);
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows > 0) {
            return $resultado->fetch_assoc();
        } else {
            return false;
        }
    }

    if (isset($_GET['logout'])) {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $usu = comprobar_usuario($_POST["usuario"], $_POST["clave"]);

        if ($usu == FALSE) {
            $err = TRUE;
            $usuario = $_POST["usuario"];
        } else {
            session_start();
            $_SESSION['id'] = $usu['id'];
            $_SESSION['usuario'] = $_POST["usuario"];
            $_SESSION['nombre'] = $usu['nombre'];

            if ($_POST["usuario"] === 'admin') {
                header("Location: ./admin/index.php");
            }
            else {
                header("Location: ./index.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles/stylesInicioSesion.css">

</head>        
<!-- Este codigo lo he modificado para poder crear una ventana emergente y que se borre -->
<body class="inicioSesion">

<?php if (isset($err)): ?>
    <div id="error-container" class="error-container">
        <p class="incorrect">Usuario o contraseña incorrectos</p>
        <span id="close-btn" class="close-btn">&times;</span>
    </div>
<?php endif; ?>


        <form action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='POST'>
        <h1>Iniciar Sesión</h1>
            <label for='usuario'class='username'>&#128100;  Usuario: </label>
            <input value='<?= isset($usuario) ? $usuario : '' ?>' name='usuario'required> 
            <label for='clave'class='password'>&#128274; Contraseña: </label>
            <input type='password' name='clave' required> 

        <div class="container">

                <button class="button" type='submit'>Acceder</button>

                <button class="button" onclick="location.href='./index.php'" > Volver</button>

        </div>
        <br>
        
        <center> <a href='registro.php' class="IrRegistro">Regístrese para comenzar el pedido</a> </center>
        <script src="./scripts/jsErrorSesión.js"></script>
        </body>
</html>



