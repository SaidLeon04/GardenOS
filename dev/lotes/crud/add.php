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


$stmt = $conexion->prepare($planta_usuario);
$stmt->bind_param('ii', $id_usuario, $id_planta);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt = $conexion->prepare($insert_lote);
    $stmt->bind_param("issiisi", $id_planta, $nombre_lote, $fecha, $cantidad, $cantidad, $estado, $id_usuario);
    $stmt->execute();
    header("Location: ../lotes.php");
}else{
    echo "La planta no existe";
}

$stmt->close();
$conexion->close();
# TODO el historial se generaba cuando se creaba el lote, waos
?>