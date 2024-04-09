<?php

include("../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];

$id_lote = $_POST['id_lote'];
$temperatura_optima = $_POST['temperatura_optima'];
$humedad_optima = $_POST['humedad_optima'];
$riego = $_POST['riego'];
$intervalo = $_POST['intervalo'];

$stmt = $conexion->prepare("SELECT * FROM lote WHERE id_lote = ?");
$stmt->bind_param("i", $id_lote);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0){
    $stmt = $conexion->prepare("UPDATE lote SET temperatura_optima = ?, humedad_optima = ?, riego = ?, intervalo = ? WHERE id_lote = ? AND id_usuario = ?");
    $stmt->bind_param("iiiiii", $temperatura_optima, $humedad_optima, $riego, $intervalo, $id_lote, $id_usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: /proyectos/garden_os/lotes");
    } else {
        echo "No se realizaron cambios.";
    }
}else{
    echo "El lote no existe";
}


?>