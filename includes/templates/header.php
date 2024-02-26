<?php
session_start();

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    // Destruir todas las variables de sesión
    session_unset();
    // Finalizar la sesión
    session_destroy();
    // Redirigir a alguna página o recargar la misma página después de cerrar sesión
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Panadería Pelayo</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel="stylesheet" href="styles/index.css" />
    <style>
        .esconde {
            display: none;
        }
    </style>
</head>

<body>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/panaderia/index.php">
                    <img src="https://res.cloudinary.com/dbqqjaqqa/image/upload/v1489836162/smaller_size_logo_wigzr1.png"></img>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/panaderia/index.php">Inicio</a></li>
                    <li><a href="contacto.php">Establecimientos</a></li>
                    <li><a href="menu.php">Menú</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['usuario'])) : ?>
                        <li class="<?php echo isset($_SESSION['usuario']) ? 'esconde' : ''; ?>">
                            <a>Bienvenido, <?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (!isset($_SESSION['usuario'])) : ?>
                        <li><a href="inicioSesion.php">Iniciar sesión</a></li>
                        <li><a href="registro.php">Registrarse</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['usuario'])) : ?>
                        <li><a href="index.php?logout=true">Cerrar sesión</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
