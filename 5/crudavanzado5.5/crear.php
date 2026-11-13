<?php
require_once 'config.php';
require_once 'funciones.php';

$employes = getEmployees($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

    create(
        $conn,
        $customerNumber,
        $customerName,
        $contactLastName,
        $contactFirstName,
        $phone,
        $addressLine1,
        $addressLine2,
        $city,
        $state,
        $postalCode,
        $country,
        $salesRepEmployeeNumber,
        $creditLimit
    );

    echo "<h3>Customer insertado correctamente</h3>";
    echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\" class=\"volverLista\"></a>";
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Customer</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="formulario" id="formulario">
        <form action="" method="post">
            <a href="index.php">
                <input type="button" value="Cancelar">
            </a>

            <label for="customerNumber">
                Customer Number:
                <input type="number" name="customerNumber" id="customerNumber" required>
            </label>
            <label for="customerName">
                Customer Name:
                <input type="text" name="customerName" id="customerName" maxlength="50" required>
            </label>
            <label for="contactLastName">
                Contact Last Name:
                <input type="text" name="contactLastName" id="contactLastName" maxlength="50" required>
            </label>
            <label for="contactFirstName">
                Contact First Name:
                <input type="text" name="contactFirstName" id="contactFirstName" maxlength="50" required>
            </label>
            <label for="phone">
                Phone:
                <input type="number" name="phone" id="phone" maxlength="50" required>
            </label>
            <label for="addressLine1">
                Address Line 1:
                <input type="text" name="addressLine1" id="addressLine1" maxlength="50" required>
            </label>
            <label for="addressLine2">
                Address Line 2:
                <input type="text" name="addressLine2" id="addressLine2" maxlength="50">
            </label>
            <label for="city">
                City:
                <input type="text" name="city" id="city" maxlength="50" required>
            </label>
            <label for="state">
                State:
                <input type="text" name="state" id="state" maxlength="50">
            </label>
            <label for="postalCode">
                Postal Code:
                <input type="text" name="postalCode" id="postalCode" maxlength="15">
            </label>
            <label for="country">
                Country:
                <input type="text" name="country" id="country" maxlength="50" required>
            </label>
            <label for="creditLimit">
                Credit Limit:
                <input type="number" step="0.01" name="creditLimit" id="creditLimit">
            </label>
            <label for="salesRepEmployeeNumber">
                Sales Rep (Employee):
                <select name="salesRepEmployeeNumber" id="salesRepEmployeeNumber">
                    <option value="">-- Sin comercial --</option>
                    <?php foreach ($employes as $employe): ?>
                        <option value=<?= $employe['employeeNumber'] ?>><?= $employe['lastName'] ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <input type="submit" value="Crear">
            <input type="reset" value="Limpiar Formulario">
        </form>


    </div>
</body>

</html>