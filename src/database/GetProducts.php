<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");

    
    $conexion = new mysqli('localhost', 'root', '','pcnomponentes');

    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }
    
    $product_id = $_GET['product_id'];


    $query = $conexion->prepare("SELECT * FROM products WHERE name = ?;");
    $query->bind_param("s", $product_id);

    $query->execute();

    $result = $query->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        
        echo json_encode($product);
    } else {
        echo json_encode(array('error' => 'Usuario no encontrado'));
    }


    $conexion->close();

?>