<?php
include("../conexion.php");

	$perdida = 0;
	$cantidad1 = 0;
	$cantidad2 = 0;
	$consulta_perdida = "SELECT * FROM historial WHERE id_lote = '$id_lote' AND estado = '$estado '";
	$resultado_perdida = mysqli_query($conexion,$consulta_perdida);
	while ($row = $resultado_perdida->fetch_array()){
		$cantidad1 += $row["cantidad"];
	}
 	
 	$consulta_perdida2 = "SELECT * FROM historial WHERE id_lote = '$id_lote' AND estado = '$estado_ciclo'";
 	$resultado_perdida2 = mysqli_query($conexion,$consulta_perdida2);
 	while ($row = $resultado_perdida2->fetch_array()) {
 		$cantidad2 += $row['cantidad'];
 	}

 	$consulta_fecha_1 = "SELECT fecha FROM historial WHERE id_lote = '$id_lote' AND estado = '$estado'";
            $resultado_fecha_1 = mysqli_query($conexion,$consulta_fecha_1);

            while ($row = $resultado_fecha_1->fetch_array()) {
                $fecha_1 = new DATETIME ($row['fecha']);
            }

          $consulta_fecha_2 = "SELECT fecha, cantidad FROM historial WHERE id_lote = '$id_lote' AND estado = '$estado_ciclo'";
            $resultado_fecha_2 = mysqli_query($conexion,$consulta_fecha_2);

            while ($row = $resultado_fecha_2->fetch_array()) {
                $fecha_2 = new DATETIME ($row['fecha']);     

            }
 	
            $diff = $fecha_1->diff($fecha_2);

 	?>
