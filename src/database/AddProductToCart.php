<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");

    $conection = 'localhost';
    $user = 'brian';
    $database = 'pcnomponentes';
    $password = 'jack';

    // connect to database
    $conexion = new mysqli($conection, $user, $password, $database);


    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $userId = $_POST['userId'];

    // verify connection
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }   


    // Prepare and execute the query
    $query = $conexion->prepare("INSERT INTO cart (id_usuario, id_producto, title, title_en, price, src, quantity)
            SELECT
                u.dni,
                p.id,
                p.title,
                p.title_en,
                p.price * ? AS price,
                p.src,
                ? AS quantity
            FROM products p
            INNER JOIN users u ON u.dni = ?
            WHERE p.title = ? OR p.title_en = ?");
    $query->bind_param("disss", $quantity, $quantity, $userId, $product, $product);


    // close connection
    $conexion->close();

?>