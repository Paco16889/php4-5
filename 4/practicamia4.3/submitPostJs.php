<?php
  $pdo = new PDO('mysql:host=localhost;dbname=northwind;charset=utf8', 'rootdaw', 'toor');

  // Campos por los que se puede filtrar (coinciden con el name de los inputs y con la columna de la BBDD)
  $campos = ['lastname', 'firstname', 'city', 'country'];

  $where  = ' WHERE 1=1';
  $params = [];
  foreach ($campos as $campo) {
    if (!empty($_POST[$campo])) {
      $where .= " AND employee.$campo LIKE :$campo";
      $params[":$campo"] = $_POST[$campo] . '%';   // empieza por...
    }
  }

  $statement = $pdo->prepare('SELECT employee.employeeId, 
  employee.lastname, 
  employee.firstname, 
  employee.title, 
  employee.titleOfCourtesy, 
  employee.birthDate, 
  employee.hireDate, 
  employee.address, 
  employee.city, 
  employee.region, 
  employee.postalCode, 
  employee.country, 
  employee.phone, 
  jefe.lastname AS jefe 
  FROM employee 
  LEFT JOIN employee AS jefe 
  ON employee.mgrId = jefe.employeeId'. $where);
  $statement->execute($params);
  $results = $statement->fetchAll(PDO::FETCH_ASSOC);

  // Devuelve HTML: el PHP construye las filas
  $tabla = "";
  foreach ($results as $fila) {
    $tabla .= "<tr>";
    foreach ($fila as $valor) {
      $tabla .= "<td>" . htmlspecialchars($valor ?? "") . "</td>";
    }
    $tabla .= "</tr>";
  }
  echo $tabla;
?>
