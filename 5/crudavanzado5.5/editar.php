<?php

require_once 'config.php';
require_once 'funciones.php';

// Recibimos el ID por GET
$id = $_GET['id'];

// Buscamos el customer y la lista de empleados para el select
$customer  = findById($conn, $id);
$employes  = getEmployees($conn);

// Si pulsamos actualizar
if (isset($_POST['actualizar'])) {

    $customerNumber         = $_POST['customerNumber'];
    $customerName           = $_POST['customerName'];
    $contactLastName        = $_POST['contactLastName'];
    $contactFirstName       = $_POST['contactFirstName'];
    $phone                  = $_POST['phone'];
    $addressLine1           = $_POST['addressLine1'];
    $addressLine2           = $_POST['addressLine2'] !== '' ? $_POST['addressLine2'] : null;
    $city                   = $_POST['city'];
    $state                  = $_POST['state'] !== '' ? $_POST['state'] : null;
    $postalCode             = $_POST['postalCode'] !== '' ? $_POST['postalCode'] : null;
    $country                = $_POST['country'];
    $creditLimit            = $_POST['creditLimit'] !== '' ? $_POST['creditLimit'] : null;
    $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'] !== '' ? $_POST['salesRepEmployeeNumber'] : null;

    // Actualizamos en la base de datos
    update($conn, $customerNumber, $customerName, $contactLastName,
           $contactFirstName, $phone, $addressLine1, $addressLine2,
           $city, $state, $postalCode, $country,
           $salesRepEmployeeNumber, $creditLimit);

    // Recargamos los datos para ver los valores nuevos en el formulario
    $customer = findById($conn, $customerNumber);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Customer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="editar.php?id=<?= $id ?>" method="POST">

        <label>
            Customer Number:
            <input type="number" name="customerNumber"
                   value="<?= $customer['customerNumber'] ?>" readonly>
        </label>

        <label>
            Customer Name:
            <input type="text" name="customerName" maxlength="50" required
                   value="<?= $customer['customerName'] ?>">
        </label>

        <label>
            Contact Last Name:
            <input type="text" name="contactLastName" maxlength="50" required
                   value="<?= $customer['contactLastName'] ?>">
        </label>

        <label>
            Contact First Name:
            <input type="text" name="contactFirstName" maxlength="50" required
                   value="<?= $customer['contactFirstName'] ?>">
        </label>

        <label>
            Phone:
            <input type="text" name="phone" maxlength="50" required
                   value="<?= $customer['phone'] ?>">
        </label>

        <label>
            Address Line 1:
            <input type="text" name="addressLine1" maxlength="50" required
                   value="<?= $customer['addressLine1'] ?>">
        </label>

        <label>
            Address Line 2:
            <input type="text" name="addressLine2" maxlength="50"
                   value="<?= $customer['addressLine2'] ?>">
        </label>

        <label>
            City:
            <input type="text" name="city" maxlength="50" required
                   value="<?= $customer['city'] ?>">
        </label>

        <label>
            State:
            <input type="text" name="state" maxlength="50"
                   value="<?= $customer['state'] ?>">
        </label>

        <label>
            Postal Code:
            <input type="text" name="postalCode" maxlength="15"
                   value="<?= $customer['postalCode'] ?>">
        </label>

        <label>
            Country:
            <input type="text" name="country" maxlength="50" required
                   value="<?= $customer['country'] ?>">
        </label>

        <label>
            Credit Limit:
            <input type="number" step="0.01" name="creditLimit"
                   value="<?= $customer['creditLimit'] ?>">
        </label>

        <label>
            Sales Rep (Employee):
            <select name="salesRepEmployeeNumber">
                <option value="">-- Sin comercial --</option>
                <?php foreach ($employes as $employe): ?>
                    <option value="<?= $employe['employeeNumber'] ?>"
                        <?= $employe['employeeNumber'] == $customer['salesRepEmployeeNumber'] ? 'selected' : '' ?>>
                        <?= $employe['lastName'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <input type="submit" name="actualizar" value="Actualizar">

        <a href="index.php">
            <input type="button" value="Cancelar">
        </a>

    </form>

<?php
if (isset($_POST['actualizar'])) {
    echo "<h3>Customer actualizado correctamente</h3>";
    echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\" class=\"volverLista\"</a>";
}
?>
</body>
</html>