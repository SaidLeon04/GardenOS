<?php 
		$conexion = mysqli_connect("localhost","root","","testgardenos");

		if(!$conexion){
			die("Error en la conexón" . mysqli_error());
		}else{
			date_default_timezone_set('America/Mexico_City');
		}
?>