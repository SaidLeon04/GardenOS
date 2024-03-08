<?php
	include("../conexion.php");

	session_start();
		$_SESSION['id_usuario'];
		$id_usuario = $_SESSION['id_usuario'];
		$id_lote = $_POST['id_lote'];
		$id_planta = $_POST['id_planta'];
		$fecha_inicio = $_POST['fecha_inicio'];
		$nombre_lote = $_POST['nombre_lote'];
		$imagen = $_POST['imagen'];
		$cantidad_inicial = $_POST['cantidad_inicial']; 
		$fecha_final = $_POST['fecha_final'];
		$cantidad_final = $_POST['cantidad_final'];

		$eficacia_cosecha = (($cantidad_final*100)/$cantidad_inicial);


	$consulta_final = "INSERT INTO historial (id_lote, estado, fecha, cantidad) VALUES ('$id_lote', 'finalizado', '$fecha_final', '$cantidad_final')";
	$resultado_consulta_final = mysqli_query($conexion, $consulta_final);
	if ($resultado_consulta_final) {
		$consulta_lote_final = "INSERT INTO lotes_terminados(id_lote, id_usuario, 
		id_planta, nombre_lote, 
		fecha_inicial, fecha_final, cantidad_inicial, cantidad_final, 
		imagen, eficacia) VALUES
		('$id_lote','$id_usuario','$id_planta','$nombre_lote','$fecha_inicio','
		$fecha_final','$cantidad_inicial','$cantidad_final','$imagen','$eficacia_cosecha')";
		$resultado_consulta_lote_final = mysqli_query($conexion,$consulta_lote_final);
		if($resultado_consulta_lote_final){
			$borrar_lote = "UPDATE lote SET estado='finalizado' WHERE id_lote = '$id_lote'";
			$resultado_borrar_lote = mysqli_query($conexion,$borrar_lote);
			if($resultado_borrar_lote){
				header("Location: lotes_terminados.php");
			}
		}
	}

	
?>		