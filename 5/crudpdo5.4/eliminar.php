<?php
require_once 'config.php';
require_once 'funciones.php';

// Recibimos el ID por GET
$id = $_GET['id'];

// Buscamos la categoría
$categoria = findById($conn, $id);

$nombrecategoria = $categoria['categoryName'];

// Si confirmamos el borrado
if (isset($_POST['confirmar'])) {

    $id = $_POST['id'];

    delete($conn, $id);

     
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar categoría</title>
</head>

<body>

    <h2>¿Estás seguro de que quieres borrar la categoría <?= $nombrecategoria ?>?</h2>

    <form action="eliminar.php?id=<?= $id ?>" method="POST">

        <input type="hidden" name="id" value="<?= $id ?>">

        <input type="submit" name="confirmar" value="Confirmar">

        <a href="index.php">
            <input type="button" value="Cancelar">
        </a>

    </form>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 echo "<h3>Categoría Borrada correctamente</h3>";
    echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\"></a>";
} ?>

</body>
</html>