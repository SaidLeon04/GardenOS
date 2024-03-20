<?php
include("../../conexion.php");
include("../../statements.php");

$id_planta = $_GET['id_planta'];
$existe = false;

    $stmt = $conexion->prepare($consulta_planta);
    $stmt->bind_param('i', $id_planta);
    $stmt->execute();
    $stmt->store_result(); 

    if ($stmt->num_rows > 0){
        $existe = true;
    }else{
        echo "La planta no existe";
    }

    if ($existe){
        $stmt= $conexion->prepare($consulta_lote);
        $stmt->bind_param("i", $id_planta);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0){
            echo "La planta existe en un lote, por lo tanto no puede ser eliminada";
        }else{
            $stmt= $conexion->prepare($borrar_planta);
            $stmt->bind_param("i", $id_planta);
            $stmt->execute();
            header("Location: ../plantas.php");
        }
    }
    $stmt->close();
    $conexion->close();
      
?>
