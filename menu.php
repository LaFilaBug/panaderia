<?php
include './includes/config/database.php';
include 'includes/templates/header.php';
function listarPanaderia()
{
    $bd = conectarDB();
    $consulta = $bd->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos");
    $consulta->execute();

    $resultado = $consulta->get_result();
    ?>
    <link rel="stylesheet" href="./styles/menuStyles.css">
    <div class="productos">
    <?php while ($row = $resultado->fetch_assoc()): ?>
        <div class="fila-producto">
            <?php
            if (!empty($row['imagen'])) {
                echo "<div class='celda-imagen'><img class='imagen-producto' src='./imagenes/" . $row['imagen'] . "'></div>";
            } else {
                echo "<div class='celda-imagen'><img class='imagen-producto' src='https://via.placeholder.com/150'></div>";
            }
            ?>
            <div class="celda-nombre">
                <?= $row['nombre'] ?>
            </div>
            <div class="celda-descripcion">
                <?= $row['descripcion'] ?>
            </div>
            <div class="celda-precio">
                <?= $row['precio'] ?>€
            </div>
            <div class="celda-boton">
            <a href="pagina_destino.php?id=<?= $row['id'] ?>" class="btn">                    <div class="celda-boton">
                        Ver más
                    </div>
                </a>
            </div>
        </div>
    <?php endwhile; ?>
</div>
    <?php
}
?>

<section>
    <?php listarPanaderia();?>
</section>


<?php     
include 'includes/templates/footer.php';
?>