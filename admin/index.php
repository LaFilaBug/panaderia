<?php
session_start();
include '../includes/config/database.php';

if (!isset($_SESSION["usuario"])) {
    header("Location: ./../../includes/templates/error403.php?redirigido=true");
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
    <table class="tableAdmin">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <?php while ($row = $resultado->fetch_assoc()) : ?>
            <tr>
                <?php
                if (!empty($row['imagen'])) {
                    echo "<td><img src='../imagenes/" . $row['imagen'] . "' width='100'></td>";
                } else {
                    echo "<td><img src='https://via.placeholder.com/150' width='100'></td>";
                }
                ?>
                <td class="tdText">
                    <?= $row['nombre'] ?>
                </td>
                <td class="tdText">
                    <?= $row['descripcion'] ?>
                </td>
                <td class="tdText">
                    <?= $row['precio'] ?>€
                </td>
                <td>
                    <div class="edits-inputs">
                        <form action='./propiedades/actualizar.php?id=<?= $row['id'] ?>' method='post' style='display: inline;'>
                            <input type='hidden' name='id' value='<?= $row['id'] ?>'>
                            <button type='submit' class='edit-admin' name='editar'>Editar</button>
                        </form>
                        <form action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post' style='display: inline;'>
                            <input type='hidden' name='id' value='<?= $row['id'] ?>'>
                            <button type='submit' class='delete-admin' name='borrar'>Borrar</button>
                        </form>
                    </div>
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
    <link rel="stylesheet" type="text/css" href="./../styles/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Panadería</title>
</head>

<body class="bodyAdmin">
    <div class="headerAdmin">
        <h1>Zona Admin</h1>

        <p>Si desea crear un producto, clickar aquí <a href="./propiedades/crear.php" class="crear">Crear Producto</a>
            <a href='./../index.php?logout=true' class='logout'>Cerrar Sesión</a>
        </p>
    </div>
    <?php listarPanaderia(); ?>

</body>

</html>