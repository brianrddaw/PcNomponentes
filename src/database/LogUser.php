<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");

    $conection = 'localhost';
    $user = 'brian';
    $database = 'pcnomponentes';
    $password = 'jack';

    $conexion = new mysqli($conection, $user, $password, $database);
  

    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }

    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];

    $query = $conexion->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $query->bind_param("ss", $user_email, $user_password);

    $query->execute();

    $result = $query->get_result();
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        echo json_encode($userData);
    } else {
        echo 'not';
    }

    $conexion->close();

?>