<?php
require_once 'config.php';
require_once 'funciones.php';

$categories = findAll($conn);
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
    <form action="insert.php">
        <input type="submit" value="Insertar">
    </form>

    <div class="resultado">
       

        
        <div class="containerresult">
          
            <table>
                <caption>Category</caption>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Picture</th>
                        <th>Editar</th>
                        <th>Eliminar</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>

                        <tr>
                            <td><?= $category['categoryId'] ?></td>
                            <td><?= $category['categoryName'] ?></td>
                            <td><?= $category['description'] ?></td>
                            <td></td>

                            <td>
                                <a href="editar.php?id=<?= $category['categoryId'] ?>">Editar</a>
                            </td>
                            <td>
                                <a href="eliminar.php?id=<?= $category['categoryId'] ?>">Eliminar</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>