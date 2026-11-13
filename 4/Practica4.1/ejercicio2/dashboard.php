<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    require_once 'cookies.php';
    $nombre = $_POST['usuario'] ?? '';
    $contra = $_POST['password'] ?? '';

    $saludo = "";



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        # code...
        if ($nombre === "usuario" && $contra === "password") {
            # code...
            session_start();
            guardaDatosSesion($nombre);
            $saludo = nombreSesion();
        } else{
            $saludo = "Nombre de usuario o contraseña incorrectos";
            echo "";
        }




        echo " <p>  {$saludo}  </p>";
    }

    function guardaDatosSesion(string $datos): void
    {
        $_SESSION['nombreUsuario'] = $datos;
        echo "Variables de sesion setteadas";
    }
    ?>

    <button onclick="window.location.href='index.php'">Volver</button>
</body>

</html>