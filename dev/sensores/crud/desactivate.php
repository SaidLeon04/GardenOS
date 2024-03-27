<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$id_sensor = $_GET['key'];

$stmt = $conexion->prepare("SELECT id_sensor FROM lote WHERE id_sensor = ? AND id_usuario = ?");
$stmt->bind_param("ii", $id_sensor, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0){
    $stmt = $conexion->prepare("UPDATE lote SET id_sensor = NULL WHERE id_sensor = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id_sensor, $id_usuario);
    $stmt->execute();
    if ($stmt->affected_rows > 0){
        $stmt->close();
        $conexion->close();
        header("Location: ../sensores.php");
    }else{
        echo "No se pudo eliminar el sensor del lote donde se encuentra";
    }
}else{
    echo "El sensor no existe";
}
?>