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
if (!$producto) {
    header("Location: ../../error404.php"); 
    exit;
}


if (!$producto) {
    header("Location: ../../error404.php"); 
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $precio = isset($_POST['precio']) && is_numeric($_POST['precio']) ? $_POST['precio'] : 0.0;


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

    // Redirigir al usuario a la página de inicio del administrador después de guardar los cambios
    header("Location: ./../index.php");
    exit;
} 

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles/stylesAdmin/actualizar.css">
    <title>Editar Producto</title>
</head>
<body class="body-class">
    <h1 class="title-class">Editar Producto</h1>
    <form class="form-class" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $idProducto); ?>" method="post" enctype="multipart/form-data">
    <label class="label-class" for="nombre">Nombre:</label>
        <input class="input-class" type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($producto['nombre']); ?>">

        <label class="label-class" for="descripcion">Descripción:</label>
        <textarea class="textarea-class" id="descripcion" name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>

        <label class="label-class" for="precio">Precio:</label>
        <input class="input-class" type="number" id="precio" name="precio" step="0.01" required value="<?php echo htmlspecialchars($producto['precio']); ?>">

        <label class="label-class" for="imagen">Imagen:</label>
        <input class="input-file-class" type="file" id="imagen" name="imagen" required>
        <input class="submit-class" type="submit" value="Guardar Cambios">
        <br>
        <a class="link-class" href="../index.php">Volver</a>
    </form>
</body>
</html>