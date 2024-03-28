<?php
include("../../conexion.php");
include("../sql/lotes.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$id_planta = $_POST['id_planta'];
$nombre_lote = $_POST['nombre_lote'];
$fecha = $_POST['fecha'];
$cantidad = $_POST['cantidad'];
$estado = $_POST['estado'];


$stmt = $conexion->prepare("SELECT * FROM plantas WHERE id_usuario = ? AND id_planta = ?");
$stmt->bind_param('ii', $id_usuario, $id_planta);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt = $conexion->prepare("INSERT INTO lote(id_planta, nombre_lote, fecha_inicial, cantidad_inicial, cantidad_actual, estado, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiisi", $id_planta, $nombre_lote, $fecha, $cantidad, $cantidad, $estado, $id_usuario);
    $stmt->execute();
    $id_lote = $conexion->insert_id;
    
    $stmt = $conexion->prepare("INSERT INTO historial(id_usuario, id_lote, estado, fecha, cantidad) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iissi", $id_usuario, $id_lote, $estado, $fecha, $cantidad);
    $stmt->execute();
    $stmt->close();
    $conexion->close();
    header("Location: ../lotes.php");
}else{
    echo "La planta no existe";
    $stmt->close();
    $conexion->close();
}

?>