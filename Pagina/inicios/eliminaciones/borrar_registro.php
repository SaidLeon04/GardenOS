<?php
include("../../conexion.php");
	$actividad = $_GET['actividad'];


	if($actividad == 'riego'){
		$id_riego = $_GET['id_riego'];
		$consulta_riegos = "DELETE  FROM riego WHERE id_riego = '$id_riego'";
		$resultado_riegos = mysqli_query($conexion,$consulta_riegos);
		if ($resultado_riegos) {
       		header("Location: ../lotes.php"); 
        }else{
        	echo "error";
       	}
	}elseif($actividad == 'temperatura'){
		$id_temperatura = $_GET['id_temperatura'];
		$consulta_temperatura = "DELETE  FROM temperatura WHERE id_temperatura = '$id_temperatura'";
		$resultado_temperatura = mysqli_query($conexion,$consulta_temperatura);
		if ($resultado_temperatura) {
       		header("Location: ../lotes.php"); 
        }else{
        	echo "error";
       	}		
	}elseif($actividad == 'humedad'){
		$id_humedad = $_GET['id_humedad'];
		$consulta_humedad = "DELETE  FROM humedad WHERE id_humedad = '$id_humedad'";
		$resultado_humedad = mysqli_query($conexion,$consulta_humedad);
		if ($resultado_humedad) {
       		header("Location: ../lotes.php"); 
        }else{
        	echo "error";
       	}
	}elseif ($actividad == 'iluminacion') {
		$id_iluminacion = $_GET['id_iluminacion'];
		$consulta_iluminacion = "DELETE  FROM iluminacion WHERE id_iluminacion = '$id_iluminacion'";
		$resultado_iluminacion = mysqli_query($conexion,$consulta_iluminacion);
		if ($resultado_iluminacion) {
       		header("Location: ../lotes.php"); 
        }else{
        	echo "error";
       	}
	}elseif ($actividad == 'cambio_tierra') {
		$id_cambio_tierra = $_GET['id_cambio_tierra'];		
		$consulta_cambio_tierra = "DELETE  FROM cambio_tierra WHERE id_tierra = '$id_cambio_tierra'";
		$resultado_cambio_tierra = mysqli_query($conexion,$consulta_cambio_tierra);
		if ($resultado_cambio_tierra) {
       		header("Location: ../lotes.php"); 
        }else{
        	echo "error";
       	}
	}elseif ($actividad == 'poda') {
		$id_poda = $_GET['id_poda'];		
		$consulta_poda = "DELETE  FROM poda WHERE id_poda = '$id_poda'";
		$resultado_poda = mysqli_query($conexion,$consulta_poda);
		if ($resultado_poda) {
       		header("Location: ../lotes.php"); 
        }else{
        	echo "error";
       	}
	}elseif ($actividad == 'crecimiento') {
		$id_crecimiento = $_GET['id_crecimiento'];		
		$consulta_crecimiento = "DELETE  FROM crecimiento WHERE id_crecimiento = '$id_crecimiento'";
		$resultado_crecimiento = mysqli_query($conexion,$consulta_crecimiento);
		if ($resultado_crecimiento) {
       		header("Location: ../lotes.php"); 
        }else{
        	echo "error";
    	}
    }


?>