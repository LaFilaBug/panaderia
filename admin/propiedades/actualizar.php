<?php
session_start();
include '../../includes/config/database.php';
$bd = conectarDB();


function obtenerProductoPorId($id)
{
    $bd = conectarDB();
    $consulta = $bd->prepare("SELECT nombre, descripcion, precio, imagen FROM productos WHERE id = ?");
    $consulta->bind_param("i", $id);
    $consulta->execute();
    $resultado = $consulta->get_result()->fetch_assoc();
    $consulta->close();
    $bd->close();
    return $resultado;
}

// Obtener su id
$idProducto = $_GET['id'];
$producto = obtenerProductoPorId($idProducto);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $precio = isset($_POST['precio']) && is_numeric($_POST['precio']) ? $_POST['precio'] : 0.0;

    // Validate the inputs
    if (empty($nombre) || empty($descripcion) || $precio <= 0) {
        // Handle the error, e.g., show an error message to the user
        $error_message = "Please ensure all fields are filled correctly.";
    } else {
        // Proceed with the update
        // ...

        $nombreImagen = $producto['imagen']; 
        if (isset($_FILES['imagen']['size']) && $_FILES['imagen']['size'] > 0) {
            $imagen = $_FILES['imagen'];
            $nombreImagen = $imagen['name'];
            $rutaImagen = '../../imagenes/' . $nombreImagen;
            move_uploaded_file($imagen['tmp_name'], $rutaImagen);
        }
        
        // Actualizar los datos del producto en la base de datos
        $consulta_actualizar = $bd->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?");
        $consulta_actualizar->bind_param("ssdsi", $nombre, $descripcion, $precio, $nombreImagen, $idProducto);
        $consulta_actualizar->execute();
    }
} else {
    header("Location: ../../error404.php");
    exit;
} 

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles/main.css">
    <title>Editar Producto</title>
</head>
<body class="product-edit-body">
    <form class="product-edit-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $idProducto); ?>" method="post" enctype="multipart/form-data">
    <h1 class="product-edit-title">Editar Producto</h1>
    <label class="product-edit-label" for="nombre">Nombre:</label>
        <input class="product-edit-input" type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($producto['nombre']); ?>">

        <label class="product-edit-label" for="descripcion">Descripción:</label>
        <textarea class="product-edit-textarea" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>

        <label class="product-edit-label" for="precio">Precio:</label>
        <input class="product-edit-input" type="number" id="precio" name="precio" step="0.01" required value="<?php echo htmlspecialchars($producto['precio']); ?>">

        <label class="product-edit-label" for="imagen">Imagen:</label>
        <input class="product-edit-input-file" type="file" id="imagen" name="imagen" required>
        <input class="product-edit-submit" type="submit" value="Guardar Cambios">
        <br>
        <a class="product-edit-link" href="../index.php">Volver</a>
    </form>
</body>
</html>