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
    $productId = $_POST['productId'];

    // Verificar conexión
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    };


    $query = $conexion->prepare("DELETE FROM cart WHERE id_usuario = ? AND id_producto = ?");
    $query->bind_param("si",  $userId, $productId);


    // Ejecutar la consulta
    if ($query->execute()) {
        if ($conexion) {
            echo "Producto borrado correctamente";
        } 
    } else {
        echo "Error al ejecutar la consulta: " . $query->error;
    };


    // Cerrar conexión
    $conexion->close();

?>