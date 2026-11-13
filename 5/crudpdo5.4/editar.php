<?php

require_once 'config.php';
require_once 'funciones.php';

// Recibimos el ID por GET
$id = $_GET['id'];

// Buscamos la categoría
$categoria = findById($conn, $id);

// Si pulsamos actualizar
if (isset($_POST['actualizar'])) {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Actualizamos en la base de datos
    update($conn, $id, $nombre, $descripcion);


}

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
    <form action="editar.php?id=<?= $id ?>" method="POST">

    <label>
        ID:
        <input type="text" name="id"
               value="<?= $categoria['categoryId'] ?>" readonly>
    </label>

    <label>
        Nombre:
        <input type="text" name="nombre"
               value="<?= $categoria['categoryName'] ?>">
    </label>

    <label>
        Descripción:
        <textarea name="descripcion"><?= $categoria['description'] ?></textarea>
    </label>

    <input type="submit" name="actualizar" value="Actualizar">

    <a href="index.php">
        <input type="button" value="Cancelar">
    </a>

</form>
 <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Volvemos al listado
      echo "<h3>Categoría Actualizada correctamente</h3>";
    echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\"></a>";
} ?>
</body>
</html>