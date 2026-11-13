<?php 
/**
 * Crea un fichero php en el que se creen 3 cookies en el sistema. 
 * En el mismo fichero llama a otro documento php que recupere esas
 *  cookies y muestre por pantalla el nombre de la cookie y el valor
 *  que tiene cada una.
 * 
 */
//crea cookies

require_once 'cookies.php';
$cookieUno = setcookie("cookieUno", "Hola soy la cookie uno");
$cookieDos = setcookie("cookieDos", "Hola soy la cookie dos");
$cookieTres = setcookie("cookieTres", "Hola soy la cookie tres");

$cookies = ["cookieUno", "cookieDos", "cookieTres"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Cookies:</h2>
    <ul>
        
     <?php 
    foreach ($cookies as $galleta) {
        # code...
        echo "<li>". recuperaCookie($galleta) . "</li>";
    }
     ?>
    </ul>
   
</body>
</html>