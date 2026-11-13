<?php

require_once 'config.php';
require_once 'funciones.php';

$employee = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Recibimos el ID por GET
    $id = $_GET['id'];

    // Buscamos el empleado
    $employee = getEmployeeById($conn, $id);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del empleado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (!$employee): ?>

    <h3>Empleado no encontrado</h3>

<?php else: ?>

    <h2>Detalle del empleado</h2>

   <table>
    <thead>
        <tr>
            <th>Employee Number</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $employee['employeeNumber'] ?></td>
            <td><?= $employee['lastName'] ?></td>
            <td><?= $employee['firstName'] ?></td>
            <td><?= $employee['email'] ?></td>
        </tr>
    </tbody>
</table>

<?php endif; ?>

    <a href="index.php">
        <input type="button" value="Volver al listado" class="volverLista">
    </a>


    
</body>
</html>