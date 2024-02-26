<?php
session_start();
include '../includes/config/database.php';

function listarPanaderia()
{
    $bd = conectarDB();
    $consulta = $bd->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos");
    $consulta->execute();

    $resultado = $consulta->get_result(); // Obtén los resultados de la consulta
    echo "<table>";
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td><img src='{$row['imagen']}' alt='{$row['nombre']}' width='100' height='100'></td>";
        echo "<td>{$row['nombre']}</td><td>{$row['descripcion']}</td><td>{$row['precio']}€</td>";
        echo "<td>";

        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post' style='display: inline;'>";
        echo "<input type='hidden' name='id' value='{$row['id']}'>";
        echo "<button type='submit' class='edit' name='editar'>Editar</button>";
        echo "</form>";

        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post' style='display: inline;'>";
        echo "<input type='hidden' name='id' value='{$row['id']}'>";
        echo "<button type='submit' class='delete' name='borrar'>Borrar</button>";
        echo "</form>";

        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../styles/admin.css">
    <title>Panadería</title>
</head>
<body>
    <?php listarPanaderia(); ?>
</body>
</html>