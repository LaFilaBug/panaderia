<!DOCTYPE html>
<html>
<head>
    <title>Título de tu página</title>
    <link rel="stylesheet" type="text/css" href="./styles/paginaDestino.css">
</head>
<body>

<?php
include 'includes/config/database.php';
include 'includes/templates/header.php';

$bd = conectarDB();

// Asegúrate de que el ID del producto está disponible, por ejemplo, a través de GET o POST
if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    $consulta = $bd->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE id = ?");
    $consulta->bind_param("i", $idProducto);
    $consulta->execute();

    $resultado = $consulta->get_result();
    $producto = $resultado->fetch_assoc();
    if ($producto) {
        // Muestra el producto
        ?>
        <body>
            <div class="producto-destino">
                <?php
                if (!empty($producto['imagen'])) {
                    echo "<div class='celda-imagen-destino'><img class='imagen-producto-destino' src='../imagenes/" . $producto['imagen'] . "'></div>";
                } else {
                    echo "<div class='celda-imagen'-destino><img class='imagen-producto-destino' src='https://via.placeholder.com/150'></div>";
                }
                ?>
                <div class="celda-nombre-destino">
                    <?= isset($producto['nombre']) ? $producto['nombre'] : '' ?>
                </div>
                <div class="celda-descripcion-destino">
                    <?= isset($producto['descripcion']) ? $producto['descripcion'] : '' ?>
                </div>
                <div class="celda-precio-destino">
                    <?= isset($producto['precio']) ? $producto['precio'] : '' ?>€
                </div>
                <div>
                    <a href="menu.php">Volver al menú</a>
                </div>
            </div>
        </body>
        <?php
    } else {
        echo "Producto no encontrado";
    }
} else {
    echo "ID de producto no proporcionado";
}

include 'includes/templates/footer.php';
?>

</body>
</html>