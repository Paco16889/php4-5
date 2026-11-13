<?php
require_once 'config.php';
require_once 'funciones.php';

// Recibimos el ID por GET
$id = $_GET['id'];

// Buscamos el customer
$customer = findById($conn, $id);

$nombrecustomer = $customer['customerName'];

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
    <title>Borrar customer</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h2>¿Estás seguro de que quieres borrar el customer <?= $nombrecustomer ?>?</h2>

    <form action="borrar.php?id=<?= $id ?>" method="POST">

        <input type="hidden" name="id" value="<?= $id ?>">

        <input type="submit" name="confirmar" value="Confirmar">

        <a href="index.php">
            <input type="button" value="Cancelar">
        </a>

    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<h3>Customer borrado correctamente</h3>";
        echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\" class=\"volverLista\"></a>";
    } ?>

</body>
</html>