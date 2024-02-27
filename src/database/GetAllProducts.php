<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");

    $conection = 'localhost';
    $user = 'brian';
    $database = 'pcnomponentes';
    $password = 'jack';


    $conexion = new mysqli($conection, $user, $password, $database);


    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }

    $query = $conexion->prepare("SELECT * FROM products");

    $query->execute();

    $result = $query->get_result();
    if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($products);
    }
    

    $conexion->close();

?>