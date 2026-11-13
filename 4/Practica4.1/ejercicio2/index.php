<?php

/**
 * Con el fichero de la tarea anterior en 
 * la que habéis hecho un login, cuando el 
 * usuario se loguee correctamente, debéis 
 * crear una sesión y guardar el nombre. Una vez 
 * hecho esto, llamáis a otro fichero php en el
 *  que lea el nombre del usuario que ha iniciado sesión
 *  y le muestre un mensaje de bienvenida.
 * 
 usuario: usuario
 contraseña: password


 */

 require_once 'cookies.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {

            display: flex;
            flex-wrap: wrap;

        }

        h2,
        p {
            width: 60%;
            margin: auto;
            padding: 1rem;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: left;
            width: 60%;
            gap: 1rem;
            margin-top: 20px;
            margin-right: auto;


        }

        label {
            display: flex;
            align-items: center;
            justify-content: right;
            gap: 10px;
        }

        input {
            width: 200px;
        }

        #boton {
            padding: 10px;
            margin-left: auto;
        }
    </style>
</head>

<body>
    <h2>Inicia Sesión </h2>

    <?php
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
    }



    
    ?>


    <form action="dashboard.php" method="post">
        <label>Usuario: <input type="text" name="usuario" required></label>
        <label>Contraseña: <input type="password" name="password" required></label>
        <input type="submit" value="Entrar" id="boton">
    </form>
</body>

</html>