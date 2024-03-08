<?php
	include("../conexion.php");
    
if(isset($_REQUEST['guardar'])){
    if (strlen($_POST['nombre_lote'])> 0  && strlen($_POST['id_planta'])> 0 && strlen($_POST['planta'])> 0 && strlen($_POST['fecha'])> 0 && strlen($_POST['estado'])> 0 && strlen($_POST['guardar'])> 0) {
        $nombre_lote = $_POST['nombre_lote'];
        $id_planta = $_POST['id_planta'];
        $planta = $_POST['planta'];
        $fecha = $_POST['fecha'];
        $estado = $_POST['estado'];
        $cantidad = $_POST['cantidad'];
        

            $consulta = "INSERT INTO lote(nombre_lote, id_planta, fecha, estado, cantidad, cantidad_variable) VALUES('$nombre_lote','$id_planta','$fecha','$estado','$cantidad','$cantidad')";

            $resultado = mysqli_query($conexion,$consulta);
            if ($resultado) {
                $consulta_lote = "SELECT id_lote FROM lote WHERE nombre_lote = '$nombre_lote'";
                $resultado_lote = mysqli_query($conexion, $consulta_lote);
                while ($row = $resultado_lote->fetch_array()) {
                    $id_lote = $row['id_lote'];
                }
               $consulta_historial = "INSERT INTO historial(id_lote,estado,fecha,cantidad) VALUES ('$id_lote','$estado','$fecha','$cantidad')";
               $resultado_historial = mysqli_query($conexion, $consulta_historial);
               if ($resultado_historial) { 
                header("Location: ../inicios/lotes.php");
               }else{
                echo "error";
               }
            }else{
                echo "error";
            }      
    }else{
        echo "no has completado los campos correctamente";
    }
}


?>