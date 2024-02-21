<?php
	include("../conexion.php");
	$id_lote = $_GET['id_lote'];

	$consulta = "SELECT estado FROM lote WHERE id_lote = '$id_lote'";
	$resultado = mysqli_query($conexion,$consulta);

	while ($row = $resultado->fetch_array()) {
		$estado = $row['estado'];
	}
		if ($estado == "germinacion"){
			$nuevo_estado = "siembra";
			$consulta = "UPDATE lote SET estado = '$nuevo_estado' WHERE $id_lote = '$id_lote'";
			$resultado = mysqli_query($conexion,$consulta);
		}
		if($estado == "siembra") {
			$nuevo_estado = "cosecha";
			$consulta = "UPDATE lote SET estado = '$nuevo_estado' WHERE $id_lote = '$id_lote'";
			$resultado = mysqli_query($conexion,$consulta);
			header("../formularios/formulario_cosechas.php");				
		}
	
?>