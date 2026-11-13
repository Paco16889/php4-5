<?php
//sacar datos para conexion

$datosdeConexion = [];
$respuestaConexion = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    $dbname = isset($_POST['dbname']) ? $_POST['dbname'] : '';
    $dbuser = isset($_POST['dbuser']) ? $_POST['dbuser'] : '';
    $dbhost = isset($_POST['dbhost']) ? $_POST['dbhost'] : '';
    $dbpassword = isset($_POST['dbpassword']) ?  $_POST['dbpassword'] : '';


    $datosdeConexion = [
        "nombre" => $dbname,
        "user" => $dbuser,
        "host" => $dbhost,
        "password" => $dbpassword
    ];




    try {
        //instancia de pdo con las credenciales de nuestra base de datos
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
        $respuestaConexion =  "Connected to $dbname at $dbhost successfully.";
        //primero show tables
        $tablasarray = dameTablas($conn);

        //por cada tablla dame las columnas de cada tabla

        $columnastablas = [];

        foreach ($tablasarray as $nombreTabla) {
            $columnasdeunatabla = dameColumnas($nombreTabla, $conn);

            //en cada tabla creame un array asociativo con las claves NOMBRES DE TABLAS Y VALORES UNA RRAY DE nombres de columnas y luego

            $columnastablas[$nombreTabla] =  $columnasdeunatabla;
        }


        //HACEMOS SELECT * DE CADA UNA DE LAS TABLAS Y GUARDAMOS SU RESULTADO
        $respuestas = [];

        foreach ($columnastablas as $key => $value) {


            $respuestas[$key] = findAll($key, $value, $conn);

            //columns son los values vamos a construir eso con dos cojones coño

        }
    } catch (PDOException $pe) {
        //respuesta conexion fallo
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }
}

function dameTablas(PDO $conn): array
{
    $showtables = 'SHOW TABLES';
    $tablasarray = [];

    $consultaTablas = $conn->query($showtables);


    while ($tabla = $consultaTablas->fetch(PDO::FETCH_ASSOC)) {

        foreach ($tabla as $key => $value) {

            array_push($tablasarray, $value);
        }
    }

    return $tablasarray;
}

function dameColumnas(string $tabla, PDO $conn): array
{
    $showcolumns = "SHOW COLUMNS FROM $tabla";
    $columnas = [];
    $columna = $conn->query($showcolumns);


    while ($resultadocolumna = $columna->fetch(PDO::FETCH_ASSOC)) {

        foreach ($resultadocolumna as $key => $value) {
            # code...
            if ($key === 'Field') {
                # code...
                array_push($columnas, $value);
            }
        }
    }

    return $columnas;
}

function findAll(string $table, array $columns, PDO $conn): array
{
    $sql = "SELECT * FROM $table";

    $filas = [];

    $query = $conn->query($sql);

    while ($resultado = $query->fetch(PDO::FETCH_ASSOC)) {

        $filas[] = createRow($columns, $resultado);
    }

    return $filas;
}

function createRow(array $columns, mixed $resultado): array
{
    $fila = [];

    foreach ($columns as $column) {
        $fila[$column] = $resultado[$column] ?? '-';
    }

    return $fila;
}


function hasJoin(string $table, PDO $conn): bool
{
    $sql = "
        SELECT EXISTS (
            SELECT 1
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = :tabla
              AND REFERENCED_TABLE_NAME IS NOT NULL
        )
    ";

    $query = $conn->prepare($sql);
    $query->execute(['tabla' => $table]);

    return  $query->fetchColumn() !== 0;
}
// function findAllWithJoins(array $tables, array $columns, PDO $conn): array
// {
//     foreach ($tables as $tabla) {
//         if (hasJoin($tabla, $conn)) {


//         }
//     }
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>CONEXIÓN SQLI</h1>
    <div class="formulario" id="formulario">
        <form action="" method="post">
            <label for="databasename">
                Nombre de la Base de Datos:
                <input type="text" name="dbname" id="databasename" required>
            </label>
            <label for="databaseuser">
                Nombre del Usuario:
                <input type="text" name="dbuser" id="databaseuser" required>
            </label>
            <label for="databasehost">
                Servidor de la Base de Datos:
                <input type="text" name="dbhost" id="databasehost" required>
            </label>
            <label for="databasepasswrd">
                Contraseña:
                <input type="password" name="dbpassword" id="databasepasswrd" required>
            </label>
            <input type="submit" value="Conectar">
            <input type="reset" value="Limiar Formulario">
        </form>
    </div>

    <div class="resultado">
        <h2>Estos son los datos para la conexion:</h2>
        <ul>
            <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {


                foreach ($datosdeConexion as $key => $value) {
                    # code...
                    echo "<li>$key : $value</li>";
                }
            }
            ?>
        </ul>
        <h4>Resultado de la conexion:</h4>
        <h5><?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                echo $respuestaConexion;
            } ?></h5>
        <div class="containerresult">
            <h4>Resultado de las consultas:</h4>
            <?php
            // sacamos las tablas por un lado

            foreach ($respuestas as $tabla => $filas) {
            ?>
                <table>
                    <caption><?php echo $tabla ?></caption>
                    <thead>
                        <tr>
                            <?php
                            foreach ($columnastablas[$tabla] as $columna) {
                                echo "<th>$columna</th>";
                            }

                            ?>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    foreach ($filas as $fila) {
                        # code...
                        echo    "<tr>";

                        foreach ($fila as $key => $value) {
                            # code...
                            echo "<td>$value</td>";
                        }

                        echo "</tr>";
                    }
            }
                    ?>
                    </tbody>
                </table>
        </div>
    </div>
</body>

</html>