<?php
include("../../conexion.php");

# TODO validar tipo de imagenes y tal vez tamaño
$id_lote = $_POST['id_lote'];
$id_usuario = $_POST['id_usuario']; #TODO valida que el lote si sea del usuario que ha hecho la solicitud
$nombre_lote = $_POST['nombre_lote']; 
$cantidad_actual = $_POST['cantidad_actual'];
$existe = false;

    $stmt = $conexion->prepare("SELECT * FROM lote WHERE id_lote = ?");
    $stmt->bind_param("i", $id_lote);
    $stmt->execute();
    $stmt->store_result(); 

    if ($stmt->num_rows > 0){
        $existe = true;
    }else{
        echo "El lote no existe";
    }

    # TODO actualizar todo? o solo los campos que se quieren cambiar?
    if($existe){
        $stmt = $conexion->prepare("UPDATE lote SET nombre_lote = ?, cantidad_actual = ? WHERE id_lote = ?");
        $stmt->bind_param("sii", $nombre_lote, $cantidad_actual, $id_lote);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: /proyectos/garden_os/lotes");
        } else {
            echo "No se realizaron cambios.";
        }
    }

$stmt->close();
$conexion->close();
    
?>