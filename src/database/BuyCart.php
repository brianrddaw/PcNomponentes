<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");

    $conection = 'localhost';
    $user = 'brian';
    $database = 'pcnomponentes';
    $password = 'jack';

    // Conectar a la base de datos
    $conexion = new mysqli($conection, $user, $password, $database);



    $userId = $_POST['userId'];

    // verify connection
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }

    // prepare and execute the query
    $insert_query = $conexion->prepare("INSERT INTO ventas(user_dni, total_amount) VALUES (?, (SELECT SUM(price * quantity) FROM cart WHERE id_usuario = ?))");
    $insert_query->bind_param("ss", $userId, $userId);

    // prepare and execute the query 
    $delete_query = $conexion->prepare("DELETE FROM cart WHERE id_usuario = ?");
    $delete_query->bind_param("s", $userId);


    // close connection
    $conexion->close();




?>