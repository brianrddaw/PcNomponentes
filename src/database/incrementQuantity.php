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


    $product = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $userId = $_POST['userId'];

    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }


    $query = $conexion->prepare("UPDATE cart
        SET quantity =  ?
        WHERE id_usuario = (SELECT dni FROM users WHERE dni = ?)
        AND id_producto = ?");
    $query->bind_param("isi", $quantity, $userId, $product);


    if ($query->execute()) {
        if ($conexion->affected_rows > 0) {
            echo "Producto agregado al carrito";
        }
    } else {
        echo "Error al ejecutar la consulta: " . $query->error;
    }




    $conexion->close();

?>