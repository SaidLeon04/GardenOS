<?php
	include("../conexion.php");
 

if(isset($_POST['guardar'])){
        $id_lote = $_POST['id_lote'];
        $estado = $_POST['estado'];
        $cantidad = $_POST['cantidad'];
        $fecha_inicio = $_POST['fecha_inicio']; 
        $estado_nuevo = $_POST['estado_nuevo'];
        $fecha_nuevo = $_POST['fecha_estado'];
        $cantidad_nuevo = $_POST['cantidad_nuevo'];

        $consulta = "INSERT INTO historial(id_lote, estado, fecha, cantidad) VALUES('$id_lote','$estado_nuevo','$fecha_nuevo', '$cantidad_nuevo')";

        $consulta_lote = "UPDATE lote SET estado = '$estado_nuevo', cantidad_variable = '$cantidad_nuevo' WHERE id_lote = '$id_lote'";

        $resultado = mysqli_query($conexion,$consulta);
        $resultado_lote = mysqli_query($conexion, $consulta_lote);
        if ($resultado && $resultado_lote) {
            header("Location: ../inicios/lotes.php");
        }else{
            echo "error";
        }
    }else{
        echo "no has completado los campos correctamente";

} 
  
?> 