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


    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $userId = $_POST['userId'];
    // $language = $_POST['language'];

    // Verificar conexión
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }


    $query = $conexion->prepare("UPDATE cart
        SET quantity = quantity + ?
        WHERE id_usuario = (SELECT dni FROM users WHERE dni = ?)
        AND id_producto = (SELECT id FROM products WHERE title = ? OR title_en = ?)");
    $query->bind_param("diss", $quantity, $userId, $product, $product);





    // Ejecutar la consulta
    if ($query->execute()) {
        if ($conexion->affected_rows > 0) {
            echo "Producto agregado al carrito";
        } else {
            echo "La consulta se ejecutó correctamente pero no se insertó ningún registro.";
        }
    } else {
        echo "Error al ejecutar la consulta: " . $query->error;
    }




    // Cerrar conexión
    $conexion->close();

?>