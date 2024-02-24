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

    // Verificar conexión
    if ($conexion->connect_error) {
        die('Failed to connect: ' . $conexion->connect_error);
    }


    $query = $conexion->prepare("INSERT INTO cart (id_usuario, id_producto, title, price, src, quantity)
        SELECT
            u.dni,
            p.id,
            p.title,
            p.price * ? AS price,
            p.src,
            ? AS quantity
        FROM products p
        INNER JOIN users u ON u.dni = ?
        WHERE p.title = ?");
    $query->bind_param("iiss", $quantity, $quantity, $userId, $product);


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