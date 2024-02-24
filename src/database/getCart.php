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

    // Preparar la consulta SQL para buscar el usuario
    // $query = $conexion->prepare("SELECT * FROM products WHERE title = '$product' OR title_en = '$product'");
    $query = $conexion->prepare("SELECT * FROM cart WHERE id_usuario = ?");
    $query->bind_param("s", $userId);

    // Ejecutar la consulta
    $query->execute();

    // Ejecutar la consulta
    if ($query->execute()) {
        if ($conexion) {

            $result = $query->get_result();
            echo json_encode($result);
        }

    } else {
        echo "Error al ejecutar la consulta: " . $query->error;
    }
    

    // Cerrar conexión
    $conexion->close();

?>