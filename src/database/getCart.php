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


    $userId = $_POST['userId'];

    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }


   $query = $conexion->prepare("SELECT * FROM cart WHERE id_usuario = ?");
    $query->bind_param("s", $userId);

    $query->execute();

    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo json_encode(array()); 
    }

    $query->close(); 

    
    $conexion->close();

?>