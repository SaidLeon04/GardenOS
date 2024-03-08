<?php
include("../conexion.php");

if(isset($_POST['eliminar'])){
    $id_planta = $_POST['id_planta'];
    $nombre_planta = $_POST['nombre_planta'];
    $validez_planta = FALSE;
    $validez = FALSE;

        $existencia_planta="SELECT nombre FROM plantas WHERE nombre = '$nombre_planta'";
        $resultado_existencia_planta = mysqli_query($conexion,$existencia_planta);
        while ($row = $resultado_existencia_planta -> fetch_array()){
            $row['nombre_planta'];
            $validez_planta = TRUE;
        }

        if ($validez_planta == TRUE) {
            $existencia_id_planta = "SELECT id_planta FROM lote WHERE id_planta = '$id_planta'";
            $existe_en_lote = mysqli_query($conexion,$existencia_id_planta);
            while ($row = $existe_en_lote->fetch_array()) {
                $row['id_planta'];
                $validez = TRUE;
            }
            if(!$validez){
                $consulta = "DELETE FROM plantas WHERE id_planta = '$id_planta'";
                $resultado = mysqli_query($conexion,$consulta);

            if ($resultado) {
                header("Location: ../inicios/plantas.php");
            }else{
                echo "error";
            }
        }else{
            echo "La planta existe en un lote y no puede ser eliminada";
        }
        } else {
            echo "La planta con el nombre: " . $nombre_planta . " no existe";
        }        
}       
?>