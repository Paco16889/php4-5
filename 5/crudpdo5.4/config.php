<?php

   try {
        //instancia de pdo con las credenciales de nuestra base de datos
        $conn = new PDO("mysql:host=localhost;dbname=northwind", 'rootdaw', 'toor');
        $respuestaConexion =  "Connected to Northwind  at localhost successfully.";
       
    } catch (PDOException $pe) {
        //respuesta conexion fallo
        die("Could not connect to the database Northwind :" . $pe->getMessage());
    }?>