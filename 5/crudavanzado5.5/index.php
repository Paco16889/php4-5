<?php
require_once 'config.php';
require_once 'funciones.php';

$customers = findAll($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>CRUD</h1>
    <form action="crear.php">
        <input type="submit" value="Insertar">
    </form>

    <div class="resultado">



        <div class="containerresult">

            <table>
                <caption>Customers</caption>
                <thead>
                    <tr>
                        <th>Customer Number</th>
                        <th>Customer Name</th>
                        <th>Contact Last Name</th>
                        <th>Contact First Name</th>
                        <th>Phone</th>
                        <th>Address Line 1</th>
                        <th>Address Line 2</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                        <th>Credit Limit</th>
                        <th>Employee Last Name</th>
                        <th>Editar</th>
                        <th>Eliminar</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>

                        <tr>
                            <td><?= $customer['customerNumber'] ?></td>
                            <td><?= $customer['customerName'] ?></td>
                            <td><?= $customer['contactLastName'] ?></td>
                            <td><?= $customer['contactFirstName'] ?></td>
                            <td><?= $customer['phone'] ?></td>
                            <td><?= $customer['addressLine1'] ?></td>
                            <td><?= $customer['addressLine2'] ?></td>
                            <td><?= $customer['city'] ?></td>
                            <td><?= $customer['state'] ?></td>
                            <td><?= $customer['postalCode'] ?></td>
                            <td><?= $customer['country'] ?></td>
                            <td><?= $customer['creditLimit'] ?></td>
                            <td><a href="employeId.php?id=<?= $customer['salesRepEmployeeNumber'] ?>"><?= $customer['lastName'] ?></a></td>

                            <td>
                                <a href="editar.php?id=<?= $customer['customerNumber'] ?>">Editar</a>
                            </td>
                            <td>
                                <a href="borrar.php?id=<?= $customer['customerNumber'] ?>">Eliminar</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>