<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];

$id_sensor = $_POST['id_sensor'];
$nombre_sensor = $_POST['nombre_sensor'];
$id_lote = $_POST['nombre_lote'];
$tipo = $_POST['tipo'];
$url_conexion = $_POST['url'];

$stmt = $conexion->prepare("SELECT * FROM sensores WHERE id_usuario = ?");
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt = $conexion->prepare("UPDATE sensores SET id_lote= ?, nombre = ?, tipo = ?, url_conexion = ? WHERE id_sensor = ?");
    $stmt->bind_param("isssi", $id_lote, $nombre_sensor, $tipo, $url_conexion, $id_sensor);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $stmt = $conexion->prepare("UPDATE lote SET id_sensor = ? WHERE id_lote = ? AND id_usuario = ?");
        $stmt->bind_param("iii", $id_sensor, $id_lote, $id_usuario);
        $stmt->execute();
        if ($stmt->affected_rows > 0){
            header("Location: /proyectos/garden_os/sensores");
        } else {
            echo "Ocurrio un error al actualizar el lote";
        }   
    } else {
        echo "Ocurrio un error al actualizar el sensor";
    }
} else {
    echo "El sensor no existe";
}

