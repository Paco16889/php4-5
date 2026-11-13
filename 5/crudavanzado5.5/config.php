<?php

   try {
        //instancia de pdo con las credenciales de nuestra base de datos
        $conn = new PDO("mysql:host=localhost;dbname=classicmodels", 'rootdaw', 'toor');
        $respuestaConexion =  "Connected to Northwind  at localhost successfully.";
       
    } catch (PDOException $pe) {
        //respuesta conexion fallo
        die("Could not connect to the database classicmodels* :" . $pe->getMessage());
    }?>