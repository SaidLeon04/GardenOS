<?php
include("../../conexion.php");
include("../sql/login.php");

if (strlen($_POST['nombre'])> 0 && strlen($_POST['passwd'])>0) {
    $nombre = trim($_POST['nombre']);
    $passwd = trim($_POST['passwd']);
	$passhash = md5($passwd);
			
	$stmt = $conexion->prepare($login_nombre);
	$stmt->bind_param("ss", $nombre, $passhash);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0){
		$usuario = $result->fetch_assoc();
		session_start();
		$_SESSION['id_usuario'] = $usuario['id_usuario'];
		$_SESSION['nombre'] = $usuario['nombre'];
		header("Location: ../../home/home.php");
		
	}else{
		echo "Nombre de usuario o contraseña incorrecta";
		# header("Location: ../../error/login_name.php");
	}
	
	$stmt = $conexion->prepare($login_correo);
	$stmt->bind_param("ss", $nombre, $passhash);
	$stmt->execute();
	$result = $stmt->get_result();
		if ($result->num_rows > 0){
			$usuario = $result->fetch_assoc();
			session_start();
			$_SESSION['id_usuario'] = $usuario['id_usuario'];
			$_SESSION['nombre'] = $usuario['nombre'];
			header("Location: ../home/home.php");
		}else{
			echo "Correo o contraseña incorrecta";
			# header("Location: ../../error/login_correo.php");
		}
	
	$stmt->close();
	$conexion->close();
}else{
	# echo "Faltan datos";
	header("Location: ../../error/login_null.php");
}
?>