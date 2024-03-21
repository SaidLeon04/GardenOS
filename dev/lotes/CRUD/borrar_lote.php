<?php
include("../../conexion.php");
include("../../statements.php");

$id_lote = $_GET['id_lote'];
$id_usuario = $_GET['id_usuario'];
$existe = false;

    $stmt = $conexion->prepare($consulta_lote);
    $stmt->bind_param('i', $id_lote);
    $stmt->execute();
    $stmt->store_result(); 

    if ($stmt->num_rows > 0){
        $existe = true;
    }else{
        echo "El lote no existe";
    }

    if ($existe){
        $stmt= $conexion->prepare($borrar_lote);
        $stmt->bind_param("i", $id_lote);
        $stmt->execute();
        header("Location: ../lotes.php");
    }else{
        echo "No se pudo eliminar el lote :(";
    }
    
    $stmt->close();
    $conexion->close();
      
?>
