<?php

require_once 'config.php';
require_once 'funcionesOffice.php';

// Recibimos el ID por GET
$id = $_GET['id'];

// Buscamos la oficina
$office = findOfficeById($conn, $id);

// Si pulsamos actualizar
if (isset($_POST['actualizar'])) {

    $officeCode         = $_POST['officeCode'];
    $city               = $_POST['city'];
    $phone              = $_POST['phone'];
    $addressLine1       = $_POST['addressLine1'];
    $addressLine2       = $_POST['addressLine2'] !== '' ? $_POST['addressLine2'] : null;
    $state              = $_POST['state'] !== '' ? $_POST['state'] : null;
    $country            = $_POST['country'];
    $postalCode         = $_POST['postalCode'];
    $territory          = $_POST['territory'];

    // Actualizamos en la base de datos
    updateOffice($conn, $officeCode, $city, $phone, $addressLine1, $addressLine2,
               $state, $country, $postalCode, $territory);

    // Recargamos los datos para ver los valores nuevos en el formulario
    $office = findOfficeById($conn, $officeCode);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Oficina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="editarOffice.php?id=<?= $id ?>" method="POST">

        <label>
            Office Code:
            <input type="text" name="officeCode" maxlength="10" required
                   value="<?= $office['officeCode'] ?>" readonly>
        </label>

        <label>
            City:
            <input type="text" name="city" maxlength="50" required
                   value="<?= $office['city'] ?>">
        </label>

        <label>
            Phone:
            <input type="text" name="phone" maxlength="50" required
                   value="<?= $office['phone'] ?>">
        </label>

        <label>
            Address Line 1:
            <input type="text" name="addressLine1" maxlength="50" required
                   value="<?= $office['addressLine1'] ?>">
        </label>

        <label>
            Address Line 2:
            <input type="text" name="addressLine2" maxlength="50"
                   value="<?= $office['addressLine2'] ?>">
        </label>

        <label>
            State:
            <input type="text" name="state" maxlength="50"
                   value="<?= $office['state'] ?>">
        </label>

        <label>
            Country:
            <input type="text" name="country" maxlength="50" required
                   value="<?= $office['country'] ?>">
        </label>

        <label>
            Postal Code:
            <input type="text" name="postalCode" maxlength="15" required
                   value="<?= $office['postalCode'] ?>">
        </label>

        <label>
            Territory:
            <input type="text" name="territory" maxlength="10" required
                   value="<?= $office['territory'] ?>">
        </label>

        <input type="submit" name="actualizar" value="Actualizar">

        <a href="index.php">
            <input type="button" value="Cancelar">
        </a>

    </form>

    <?php
    if (isset($_POST['actualizar'])) {
        echo "<h3>Oficina actualizada correctamente</h3>";
        echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\" class=\"volverLista\"></a>";
    }
    ?>
</body>
</html>
