<?php
include("../../conexion.php");

if(isset($_POST['eliminar'])){
    $id_planta = $_POST['id_planta'];
    $nombre = $_POST['nombre_planta'];
    $existe = false;

    $stmt = $conexion->prepare("SELECT nombre AND id_planta FROM plantas WHERE nombre = ? AND id_planta = ?");
    $stmt->bind_param("si", $nombre, $id_planta);
    $stmt->execute();
    $stmt->store_result(); 

    if ($stmt->num_rows > 0){
        $existe = true;
    }else{
        echo "La planta " . $nombre . " no existe";
    }

    if ($existe){
        $stmt= $conexion->prepare("SELECT id_planta FROM lote WHERE id_planta = ?");
        $stmt->bind_param("i", $id_planta);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0){
            echo "La planta existe en un lote, por lo tanto no puede ser eliminada";
        }else{
            $stmt= $conexion->prepare("DELETE FROM plantas WHERE id_planta = ?");
            $stmt->bind_param("i", $id_planta);
            $stmt->execute();
            header("Location: ../plantas.php");
        }
    }
}       
?>
