<?php
require_once 'config.php';
require_once 'funcionesOffice.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $officeCode         = $_POST['officeCode'];
    $city               = $_POST['city'];
    $phone              = $_POST['phone'];
    $addressLine1       = $_POST['addressLine1'];
    $addressLine2       = $_POST['addressLine2'] !== '' ? $_POST['addressLine2'] : null;
    $state              = $_POST['state'] !== '' ? $_POST['state'] : null;
    $country            = $_POST['country'];
    $postalCode         = $_POST['postalCode'];
    $territory          = $_POST['territory'];

    createOffice(
        $conn,
        $officeCode,
        $city,
        $phone,
        $addressLine1,
        $addressLine2,
        $state,
        $country,
        $postalCode,
        $territory
    );

    echo "<h3>Oficina insertada correctamente</h3>";
    echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\" class=\"volverLista\"></a>";
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Oficina</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="formulario" id="formulario">
        <form action="" method="post">
            <a href="index.php">
                <input type="button" value="Cancelar">
            </a>

            <label for="officeCode">
                Office Code:
                <input type="text" name="officeCode" id="officeCode" maxlength="10" required>
            </label>
            <label for="city">
                City:
                <input type="text" name="city" id="city" maxlength="50" required>
            </label>
            <label for="phone">
                Phone:
                <input type="text" name="phone" id="phone" maxlength="50" required>
            </label>
            <label for="addressLine1">
                Address Line 1:
                <input type="text" name="addressLine1" id="addressLine1" maxlength="50" required>
            </label>
            <label for="addressLine2">
                Address Line 2:
                <input type="text" name="addressLine2" id="addressLine2" maxlength="50">
            </label>
            <label for="state">
                State:
                <input type="text" name="state" id="state" maxlength="50">
            </label>
            <label for="country">
                Country:
                <input type="text" name="country" id="country" maxlength="50" required>
            </label>
            <label for="postalCode">
                Postal Code:
                <input type="text" name="postalCode" id="postalCode" maxlength="15" required>
            </label>
            <label for="territory">
                Territory:
                <input type="text" name="territory" id="territory" maxlength="10" required>
            </label>

            <input type="submit" value="Crear">
            <input type="reset" value="Limpiar Formulario">
        </form>



    </div>
</body>

</html>
