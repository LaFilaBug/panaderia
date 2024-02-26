<?php
session_start();

include '../../includes/config/database.php';
$bd = conectarDB();

// Obtener las categorías de la base de datos
$stmt = $bd->prepare("SELECT * FROM categorias");
$stmt->execute();

$result = $stmt->get_result();
$categorias = $result->fetch_all(MYSQLI_ASSOC);

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';

    // Manejo de la imagen
    $errores = [];
    $imagen = $_FILES['imagen'];
    $medida = 1000 * 1000 * 10;

    if ($imagen["size"] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }

    if (empty($errores)) {
        $carpetaImagenes = '../../imagenes/';
        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        // Generar un nombre característico
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);

        $stmt = $bd->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen, categorias_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssdss', $nombre, $descripcion, $precio, $nombreImagen, $categoria);
        $stmt->execute();

        header('Location: ../index.php');
    } 
} else {
?>
    <h1>Zona Admin CREAR</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required>

        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" required>

        <input type="submit" value="Guardar Producto">
    </form>
<?php
}
?>