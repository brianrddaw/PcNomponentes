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


   $query = $conexion->prepare("SELECT * FROM cart WHERE id_usuario = ?");
    $query->bind_param("s", $userId);

    // Ejecutar la consulta
    $query->execute();

    // Obtener resultados
    $result = $query->get_result();

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        $rows = array();
        // Iterar sobre los resultados y agregarlos a un array
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        // Enviar los resultados como respuesta JSON
        echo json_encode($rows);
    } else {
        // Si no hay resultados
        echo json_encode(array()); // Enviar un array vacío como respuesta JSON
    }

    $query->close(); // Cierra la consulta preparada

    

    // Cerrar conexión
    $conexion->close();

?>