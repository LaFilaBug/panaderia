<?php
include "includes/config/database.php";

$bd = conectarDB();

function listarPizzas($conn)
{
    $consulta = $conn->prepare("SELECT * FROM productos");
    $consulta->execute();

    echo "<table border='1'>";
    echo "<tr><th>Productos</th><th>Ingredientes</th><th>Precio</th><th>Coste</th><th>Acciones Admin</th></tr>";

    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<tr>";
        echo "<td>$row[nombre]</td><td>$row[ingredientes]</td><td>$row[precio]€</td><td>$row[coste]€</td>";
        echo "<td>";

        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post' style='display: inline;'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<button type='submit' name='editar'>Editar</button>";
        echo "</form>";

        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post' style='display: inline;'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<button type='submit' name='borrar'>Borrar</button>";
        echo "</form>";

        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
}