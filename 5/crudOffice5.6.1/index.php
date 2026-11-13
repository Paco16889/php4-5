<?php
require_once 'config.php';
require_once 'funcionesOffice.php';

$offices = findAllOffices($conn);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Oficinas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>CRUD Oficinas</h1>
    <form action="crearOffice.php">
        <input type="submit" value="Insertar">
    </form>

    <div class="resultado">


        <div class="containerresult">

            <table>
                <caption>Oficinas</caption>
                <thead>
                    <tr>
                        <th>Office Code</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>Address Line 1</th>
                        <th>Address Line 2</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Postal Code</th>
                        <th>Territory</th>
                        <th>Editar</th>
                        <th>Eliminar</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($offices as $office): ?>

                        <tr>
                            <td><?= $office['officeCode'] ?></td>
                            <td><?= $office['city'] ?></td>
                            <td><?= $office['phone'] ?></td>
                            <td><?= $office['addressLine1'] ?></td>
                            <td><?= $office['addressLine2'] ?></td>
                            <td><?= $office['state'] ?></td>
                            <td><?= $office['country'] ?></td>
                            <td><?= $office['postalCode'] ?></td>
                            <td><?= $office['territory'] ?></td>
                            <td>
                                <a href="editarOffice.php?id=<?= $office['officeCode'] ?>">Editar</a>
                            </td>
                            <td>
                                <a href="borrarOffice.php?id=<?= $office['officeCode'] ?>">Eliminar</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
