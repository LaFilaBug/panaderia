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
            <div class="producto">
                <?php
                if (!empty($producto['imagen'])) {
                    echo "<div class='celda-imagen'><img class='imagen-producto' src='../imagenes/" . $producto['imagen'] . "'></div>";
                } else {
                    echo "<div class='celda-imagen'><img class='imagen-producto' src='https://via.placeholder.com/150'></div>";
                }
                ?>
                <div class="celda-nombre">
                    <?= isset($producto['nombre']) ? $producto['nombre'] : '' ?>
                </div>
                <div class="celda-descripcion">
                    <?= isset($producto['descripcion']) ? $producto['descripcion'] : '' ?>
                </div>
                <div class="celda-precio">
                    <?= isset($producto['precio']) ? $producto['precio'] : '' ?>€
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