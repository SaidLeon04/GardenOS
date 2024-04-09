<?php
include("../../conexion.php");


session_start();
$id_usuario = $_SESSION['id_usuario'];
$id_planta = $_POST['id_planta'];
$nombre_lote = $_POST['nombre_lote'];
$fecha = $_POST['fecha'];
$cantidad = $_POST['cantidad'];
$estado = $_POST['estado'];
$id_sensor = 0;

$stmt = $conexion->prepare("SELECT * FROM plantas WHERE id_usuario = ? AND id_planta = ?");
$stmt->bind_param('ii', $id_usuario, $id_planta);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt = $conexion->prepare("INSERT INTO lote(id_planta, nombre_lote, fecha_inicial, cantidad_inicial, cantidad_actual, estado, id_usuario, id_sensor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiisii", $id_planta, $nombre_lote, $fecha, $cantidad, $cantidad, $estado, $id_usuario, $id_sensor);
    $stmt->execute();
    $id_lote = $conexion->insert_id;
    
    $stmt = $conexion->prepare("INSERT INTO historial(id_usuario, id_lote, estado, fecha, cantidad) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iissi", $id_usuario, $id_lote, $estado, $fecha, $cantidad);
    $stmt->execute();
    $stmt->close();
    $conexion->close();
    header("Location: /proyectos/garden_os/lotes");
}else{
    echo "La planta no existe";
    $stmt->close();
    $conexion->close();
}

?>