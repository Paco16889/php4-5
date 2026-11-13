
<?php

require_once 'config.php';
require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['name'];
    $descripcion = $_POST['description'];


    create($conn, $nombre, $descripcion);

 
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
     <div class="formulario" id="formulario">
        <form action="" method="post">
            
            <label for="name">
                Nombre:
                <input type="text" name="name" id="name" required>
            </label>
            <label for="description">
                Descripción:
                <input type="text" name="description" id="description" required>
            </label>
            <label for="picture">
                Contraseña:
                <input type="file" name="picture" id="picture">
            </label>
            <input type="submit" value="Crear">
            <input type="reset" value="Limiar Formulario">
        </form>
        
<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


      echo "<h3>Categoría insertada correctamente</h3>";
     echo "<a href='index.php'><input type=\"button\" value=\"Volver al listado\"></a>";
}

?>
    </div>
</body>
</html>
