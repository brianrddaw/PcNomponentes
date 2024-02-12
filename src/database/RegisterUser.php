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
    $user_name = $_POST['userName'];
    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];

    // Preparar la consulta SQL para buscar el usuario
    $query = $conexion->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $query->bind_param("sss", $user_name, $user_email, $user_password);

    // Ejecutar la consulta
    $query->execute();

    // Obtener los resultados
    $result = $query->get_result();

    echo ($result);

    // Cerrar conexión
    $conexion->close();

?>