
<?php
function nombreSesion(): string
{
    if (isset($_SESSION['nombreUsuario'])) {
        # code...

        $valorSesion = $_SESSION['nombreUsuario'];
        return "Bienvenido a tu sesión: {$valorSesion}";
    } else {
        return "Fallo al iniciar sesión";
    }
}
?>
