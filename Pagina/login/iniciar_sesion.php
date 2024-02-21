<?php
	include("../conexion.php");

	if(isset($_POST['acceder'])){
    	if (strlen($_POST['usuario'])> 0 && strlen($_POST['passwd'])>0) {
        	$usuario = trim($_POST['usuario']);
        	$passwd = trim($_POST['passwd']);
			// $passhash = md5($passwd);

			$query = "SELECT id_usuario, nombre, passwd FROM usuarios WHERE nombre='$usuario' AND passwd='$passwd'";
			$resultado = mysqli_query($conexion,$query);
			if($resultado == TRUE){
				while($row = $resultado->fetch_array()){
					$id_usuario = $row['id_usuario'];
					$nombre_usuario = $row['nombre'];
					
					session_start();
					$_SESSION['id_usuario'] = $id_usuario; 
					$_SESSION['nombre'] = $nombre_usuario;

					header("Location: ../inicios/home.php");
				}
			}else{
?>
<link rel="stylesheet" type="text/css" href="../estilos_error.css">
	<title>ERROR</title>
<div class="error-container">
    	<h1>Error</h1>
    	<p>Usuario o contraseña incorrectos</p>
       <a href="iniciar_sesion.html"><button>VOLVER</button></a>
</div>
<?php

			}
			
		}
	}
?>