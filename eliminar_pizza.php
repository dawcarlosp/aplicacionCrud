<?php
$conexion = new mysqli('localhost', 'pizzas_db', 'pizzas_db', 'pizzas_db');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$datos = json_decode(file_get_contents('php://input'), true);
$id = $conexion->real_escape_string($datos['id']);

$sql = "DELETE FROM pizzas WHERE id = '$id'";

if ($conexion->query($sql) === TRUE) {
    echo json_encode(["mensaje" => "Pizza eliminada exitosamente."]);
} else {
    echo json_encode(["mensaje" => "Error al eliminar la pizza: " . $conexion->error]);
}

$conexion->close();
?>
