<?php
require_once 'config.php';
require_once 'funcionesOffice.php';

// Recibimos el ID por GET
$id = $_GET['id'];

// Buscamos la oficina
$office = findOfficeById($conn, $id);

$city = $office['city'];

// Si confirmamos el borrado
if (isset($_POST['confirmar'])) {

    $id = $_POST['id'];

    deleteOffice($conn, $id);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar oficina</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h2>¿Estás seguro de que quieres borrar la oficina de <?= $city ?>?</h2>

    <form action="borrarOffice.php?id=<?= $id ?>" method="POST">

        <input type="hidden" name="id" value="<?= $id ?>">

        <input type="submit" name="confirmar" value="Confirmar">

        <a href="index.php">
            <input type="button" value="Cancelar">
        </a>

    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<h3>Oficina borrada correctamente</h3>";
        echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\" class=\"volverLista\"></a>";
    } ?>
</body>
</html>
