<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");

 
    $conection = 'localhost';
    $user = 'brian';
    $database = 'pcnomponentes';
    $password = 'jack';

    // Connect
    $conexion = new mysqli($conection, $user, $password, $database);
  

    // Verify connection
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }

    try {
        // Obtain user data
        $user_id = $_POST['userId'];
        $user_email = $_POST['userEmail'];
        $user_password = $_POST['userPassword'];
        $user_phone = $_POST['userPhone'];
        $user_bank_account = $_POST['userBankAccount'];
        $user_name = $_POST['userName'];

        // Prepare and execute the query
        $query = $conexion->prepare("INSERT INTO users (dni, email, password, phone_number, bank_account, name) VALUES (?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssssss", $user_id, $user_email, $user_password, $user_phone, $user_bank_account, $user_name);

        // Execute the query
        $result = $query->execute();

        if ($result) {
            echo "true"; // Indicate success
        } else {
            echo "false"; // Indicate failure
        }
    } catch (Exception $e) {
        echo "false"; // Indicate failure
    }

    // Close the connection
    $conexion->close();


?>