<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$id_lote = $_POST['id_lote'];
$fecha = $_POST['fecha'];
$cantidad = $_POST['cantidad'];
$estado = $_POST['estado'];


$stmt = $conexion->prepare("SELECT * FROM lote WHERE id_usuario = ? AND id_lote = ?");
$stmt->bind_param('ii', $id_usuario, $id_lote);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt = $conexion->prepare("UPDATE lote SET cantidad_actual = ?, estado = ? WHERE id_lote = ? AND id_usuario = ?");
    $stmt->bind_param("isii", $cantidad, $estado, $id_lote, $id_usuario);
    $stmt->execute();

    
    $stmt = $conexion->prepare("INSERT INTO historial(id_usuario, id_lote, estado, fecha, cantidad) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iissi", $id_usuario, $id_lote, $estado, $fecha, $cantidad);
    $stmt->execute();
    $stmt->close();
    $conexion->close();
    header("Location: /proyectos/garden_os/lotes");
}else{
    echo "El lote no existe";
    $stmt->close();
    $conexion->close();
}

?>