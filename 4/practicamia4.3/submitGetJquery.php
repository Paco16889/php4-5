<?php
  $pdo = new PDO('mysql:host=localhost;dbname=northwind;charset=utf8', 'rootdaw', 'toor');

  // Campos por los que se puede filtrar (coinciden con el name de los inputs y con la columna de la BBDD)
  $campos = ['lastname', 'firstname', 'city', 'country'];

  $where  = ' WHERE 1=1';
  $params = [];
  foreach ($campos as $campo) {
    if (!empty($_GET[$campo])) {
      $where .= " AND employee.$campo LIKE :$campo";
      $params[":$campo"] = $_GET[$campo] . '%';   // empieza por...
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
  ON employee.mgrId = jefe.employeeId' . $where);
  $statement->execute($params);
  $results = $statement->fetchAll(PDO::FETCH_ASSOC);

  // Devuelve JSON: el JavaScript construye la tabla
  header("Content-Type: application/json");
  echo json_encode($results);
?>
