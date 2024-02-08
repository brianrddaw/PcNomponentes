<?php
    // Conectar a la base de datos
    $conexion = new mysqli('localhost', 'root', 'pcnomponentes', '');

    // Verificar conexión
    if ($conexion->connect_error) {
    die('Failed to connect: ' . $conexion->connect_error);
    }

    // Obtener el nombre del producto
    $product_name = 'Keyboard'; // Cambiar por el nombre del producto que se desea buscar

    // Preparar la consulta SQL para buscar el producto
    $query = $conexion->prepare("SELECT * FROM products WHERE name = ?");

    // Ejecutar la consulta
    $query->execute();

    // Obtener los resultados
    $result = $query->get_result();
    if ($result->num_rows > 0) {
    // Si hay resultados, enviar los datos del producto
    $product = $result->fetch_assoc();
    echo json_encode($product);
    } else {
    // Si no hay resultados, enviar una respuesta vacía
    echo json_encode(array('error' => 'Producto no encontrado'));
    }

    // Cerrar conexión
    $conexion->close();


?>