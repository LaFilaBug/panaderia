<?php
session_start();
include '../includes/config/database.php';

if (!isset($_SESSION["usuario"])) {
    header("Location: ./error403.php?redirigido=true");
    exit;
}

function borrarProducto($id)
{
    $bd = conectarDB();

    // Obtener el nombre 
    $consulta = $bd->prepare("SELECT imagen FROM productos WHERE id = ?");
    $consulta->bind_param("i", $id);
    $consulta->execute();
    $consulta->bind_result($imagen);
    $consulta->fetch();
    $consulta->close();

    // Eliminar la imagen
    if ($imagen != null) {
        $rutaImagen = '../imagenes/' . $imagen;
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }
    }

    // Eliminar el producto de la base de datos
    $consulta = $bd->prepare("DELETE FROM productos WHERE id = ?");
    $consulta->bind_param("i", $id);
    $consulta->execute();

    $consulta->close();
    $bd->close();
}

if (isset($_POST['borrar'])) {
    $id = $_POST['id'];
    borrarProducto($id);
}



function listarPanaderia()
{
    $bd = conectarDB();
    $consulta = $bd->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos");
    $consulta->execute();

    $resultado = $consulta->get_result();
    ?>
    <table>
        <h1>Zona Admin</h1>
        <h2>Hola,
            <?php echo $_SESSION['nombre'] ?>
        </h2>
        <p>Si desea crear un producto, clickar aquí <a href="./propiedades/crear.php">Crear Producto</a></p>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <?php
                if (!empty($row['imagen'])) {
                    echo "<td><img src='../imagenes/" . $row['imagen'] . "' width='100'></td>";
                } else {
                    echo "<td><img src='https://via.placeholder.com/150' width='100'></td>";
                }
                ?>
                <td>
                    <?= $row['nombre'] ?>
                </td>
                <td>
                    <?= $row['descripcion'] ?>
                </td>
                <td>
                    <?= $row['precio'] ?>€
                </td>
                <td>
                    <form action='./propiedades/actualizar.php?id=<?= $row['id'] ?>' method='post' style='display: inline;'>
                        <input type='hidden' name='id' value='<?= $row['id'] ?>'>
                        <button type='submit' class='edit' name='editar'>Editar</button>
                    </form>

                    <form action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post' style='display: inline;'>
                        <input type='hidden' name='id' value='<?= $row['id'] ?>'>
                        <button type='submit' class='delete' name='borrar'>Borrar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <?php
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
    <a href='../../index.php?logout=true'>Cerrar Sesión</a>
</body>

</html>