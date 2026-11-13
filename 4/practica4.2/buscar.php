<?php 
header('Content-Type: application/json');

//array de platos vacio
$platos = [];

//fichero que vamos a trabajar y en que modo (lectura mas escritura r+)
$fichero = fopen("platos.csv", "r");


//comprobación de que ha pillado elfichero
if ($fichero !== false) {
        $maxLenght = 0;

//php 8 para arriba puedes meter 0 o nnull al getcsv y coje longitud ilimmitada pero 
//aterior hay que sacar la longitud de la linea mas larga
    while (($fila = fgets($fichero)) !== false) {
        # code...
        if (strlen($fila) > $maxLenght ) {
            # code...
            $maxLenght = strlen($fila);
        }

        
    }
//nos cmemos la primera 
    //fgetcsv($fichero);
rewind($fichero);


    while (($fila = fgetcsv($fichero, $maxLenght, ",")) !== false) {
        # code...

        
    $platos[] = $fila;
    }
    fclose($fichero);
}


$userInput = '';

//sacar user input desde post
if($_SERVER['REQUEST_METHOD'] === 'POST'){
   

    isset($_POST['buscar']) ? $userInput = $_POST['buscar'] : $userInput = '';
}else if($_SERVER['REQUEST_METHOD'] === 'GET'){
   
//SACAR GET
    isset($_GET['buscar']) ? $userInput = $_GET['buscar'] : $userInput = '';
}


$resultados = [];
foreach ($platos as $fila) {
    # code...


if ((stripos($fila[0], $userInput) !== false) ) {
    # code...
//metemos siempre el valor de la primera filacomo claves
    $resultados[] = [
        $platos[0][0] => $fila [0],
        $platos[0][1] => $fila [1]
    ];
}

}
echo json_encode($resultados);


?>

