<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$id_lote = $_GET['id_lote'];

$stmt = $conexion->prepare("SELECT * FROM lote WHERE id_usuario = ? AND id_lote = ?");
$stmt->bind_param('ii', $id_usuario, $id_lote);
$stmt->execute();
$result = $stmt->get_result(); 
if ($result->num_rows > 0){
    $stmt= $conexion->prepare("DELETE FROM lote WHERE id_lote = ?");
    $stmt->bind_param("i", $id_lote);
    $stmt->execute();
    $stmt->close();
    $conexion->close();
    header("Location: /proyectos/garden_os/lotes");
}else{
    echo "El lote no existe";
}      
?>
