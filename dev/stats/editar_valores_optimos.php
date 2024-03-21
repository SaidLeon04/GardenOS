<?php

include("../conexion.php");
include("../statements.php");

$id_lote = $_POST['id_lote'];

$temperatura_optima = $_POST['temperatura_optima'];
$humedad_optima = $_POST['humedad_optima'];
$existe = false;

$stmt = $conexion->prepare($consulta_lote);
$stmt->bind_param("i", $id_lote);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0){
    $existe = true;
}else{
    echo "El lote no existe";
}

if($existe){
    $stmt = $conexion->prepare($actualizar_valores_optimos);
    $stmt->bind_param("iii", $temperatura_optima, $humedad_optima, $id_lote);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../lotes/lotes.php");
    } else {
        echo "No se realizaron cambios.";
    }
}

?>