<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");

    // echo 'hola';

    // Conectar a la base de datos
    $conexion = new mysqli('localhost', 'root', 'pcnomponentes', '');

    // Verificar conexión
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }

    // Obtener el ID del usuario desde la URL
    $product_id = $_GET['product_id'];

    // Preparar la consulta SQL para buscar el usuario
    $query = $conexion->prepare("SELECT * FROM products WHERE product_id = ?;");
    $query->bind_param("s", $product_id);

    // Ejecutar la consulta
    $query->execute();

    // Obtener los resultados
    $result = $query->get_result();
    if ($result->num_rows > 0) {
        // Si hay resultados, enviar los datos del usuario
        $product = $result->fetch_assoc();
        
        echo json_encode($product);
    } else {
        // Si no hay resultados, enviar una respuesta vacía
        echo json_encode(array('error' => 'Usuario no encontrado'));
    }

    

    // Cerrar conexión
    $conexion->close();

?>