<?php
$conexion = new mysqli('localhost', 'pizzas_db', 'pizzas_db', 'pizzas_db');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT id, masa, especialidad, precio, cliente FROM pizzas";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $pizzas = [];
    while ($fila = $resultado->fetch_assoc()) {
        $pizzas[] = $fila;
    }
    echo json_encode($pizzas);
} else {
    echo json_encode([]);
}

$conexion->close();
?>
