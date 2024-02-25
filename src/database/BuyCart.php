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

    // Verificar conexión
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }

    // Preparar la consulta de inserción
    $insert_query = $conexion->prepare("INSERT INTO ventas(user_dni, total_amount) VALUES (?, (SELECT SUM(price * quantity) FROM cart WHERE id_usuario = ?))");
    $insert_query->bind_param("ss", $userId, $userId);

    // Preparar la consulta de borrado
    $delete_query = $conexion->prepare("DELETE FROM cart WHERE id_usuario = ?");
    $delete_query->bind_param("s", $userId);

    // Ejecutar ambas consultas y verificar el éxito de ambas
    if ($insert_query->execute() && $delete_query->execute()) {
        echo "Compra realizada";
    } else {
        echo "Error al ejecutar la consulta: " . $insert_query->error;
    }

    // Cerrar conexión
    $conexion->close();




?>