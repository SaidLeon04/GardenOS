<?php
	include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['nombre'])> 0 && strlen($_POST['tipo'])> 0 && strlen($_POST['descripcion'])> 0) {
        $id_usuario = $_POST['id_usuario'];
        $nombre = trim($_POST['nombre']);
        $tipo = trim($_POST['tipo']);
        $descripcion = trim($_POST['descripcion']);
        $temporal_imagen = $_FILES['imagen']['tmp_name'];
        $image = base64_encode(file_get_contents(addslashes($temporal_imagen)));
 
        $consulta = "INSERT INTO plantas(id_usuario, nombre, tipo, descripcion, imagen) VALUES('$id_usuario','$nombre','$tipo','$descripcion','$image')";

        $resultado = mysqli_query($conexion,$consulta);

        if ($resultado) {
            header("Location: plantas.php");
        }else{
            echo "error";
        }
    }else{
        echo "no has completado los campos correctamente";
    }
}   

?>