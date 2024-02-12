<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");

    // echo 'hola';
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

    // Obtener el ID del usuario desde la URL
    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];

    // Preparar la consulta SQL para buscar el usuario
    $query = $conexion->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $query->bind_param("ss", $user_email, $user_password);

    // Ejecutar la consulta
    $query->execute();

    // Obtener los resultados
    $result = $query->get_result();
    if ($result->num_rows > 0) {
        // Usuario existe
        $userData = $result->fetch_assoc();
        echo json_encode($userData);
    } else {
        // Usuario no existe
        echo 'not';
    }

    // Cerrar conexión
    $conexion->close();

?>