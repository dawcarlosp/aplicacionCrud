<?php
$conexion = new mysqli('localhost', 'pizzas_db', 'pizzas_db', 'pizzas_db');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$datos = json_decode(file_get_contents('php://input'), true);

$id = $conexion->real_escape_string($datos['id']);
$masa = $conexion->real_escape_string($datos['masa']);
$especialidad = $conexion->real_escape_string($datos['especialidad']);
$precio = $conexion->real_escape_string($datos['precio']);
$cliente = $conexion->real_escape_string($datos['cliente']);

$sql = "UPDATE pizzas SET masa = '$masa', especialidad = '$especialidad', precio = '$precio', cliente = '$cliente' WHERE id = '$id'";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(["mensaje" => "Pizza actualizada exitosamente."]);
} else {
    echo json_encode(["mensaje" => "Error al actualizar la pizza: " . $conexion->error]);
}

$conexion->close();
?>
