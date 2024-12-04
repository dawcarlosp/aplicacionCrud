<?php
$conexion = new mysqli('localhost', 'pizzas_db', 'pizzas_db', 'pizzas_db');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$datos = json_decode(file_get_contents('php://input'), true);

$masa = $conexion->real_escape_string($datos['masa']);
$especialidad = $conexion->real_escape_string($datos['especialidad']);
$precio = $conexion->real_escape_string($datos['precio']);
$cliente = $conexion->real_escape_string($datos['cliente']);

$sql = "INSERT INTO pizzas (masa, especialidad, precio, cliente) VALUES ('$masa', '$especialidad', '$precio', '$cliente')";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(["mensaje" => "Pizza agregado exitosamente."]);
} else {
    echo json_encode(["mensaje" => "Error al agregar el pizza: " . $conexion->error]);
}

$conexion->close();
?>