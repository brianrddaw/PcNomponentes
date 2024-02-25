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
    $user_id = $_POST['userId'];
    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];
    $user_phone = $_POST['userPhone'];
    $user_bank_account = $_POST['userBankAccount'];
    $user_name = $_POST['userName'];

    // Preparar la consulta SQL para buscar el usuario
    $query = $conexion->prepare("INSERT INTO users (dni, email, password, phone_number, bank_account, name) VALUES (?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssss", $user_id, $user_email, $user_password, $user_phone, $user_bank_account, $user_name);

    // Ejecutar la consulta
    $query->execute();

    // Obtener los resultados
    $result = $query->get_result();

    echo ($result);

    // Cerrar conexión
    $conexion->close();

?>