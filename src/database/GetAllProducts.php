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

    // Verificar conexión
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }

    // Preparar la consulta SQL para buscar el usuario
    $query = $conexion->prepare("SELECT * FROM products");

    // Ejecutar la consulta
    $query->execute();

    // Obtener los resultados
    $result = $query->get_result();
    if ($result->num_rows > 0) {
        // Si hay resultados, enviar los datos del usuario
        $products = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($products);
    }
    

    // Cerrar conexión
    $conexion->close();

?>