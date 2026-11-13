<?php 

function recuperaCookie(string $cookie):string{

if (isset($_COOKIE[$cookie])) {
    # code...
        $valorCookie = $_COOKIE[$cookie];
        $valoresCookie = "El nombre de la cookie es: {$cookie}, y su valor es {$valorCookie}";

}else {
    $valoresCookie = "La cookie {$cookie} no existe.";
}
    return $valoresCookie;
}
?>