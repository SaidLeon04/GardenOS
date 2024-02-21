<?php
	include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['nombre'])> 0 && strlen($_POST['tipo'])> 0 && strlen($_POST['descripcion'])> 0) {
        $id_usuario = $_POST['id_usuario'];
        $nombre = trim($_POST['nombre']);
        $tipo = trim($_POST['tipo']);
        $descripcion = trim($_POST['descripcion']);
 
        # imagen
        $file = $_FILES["imagen"]["name"];
        $validar = 1;
        $file_type = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        $url_temp = $_FILES["imagen"]["tmp_name"];
        $url_insert = "../img"; 
        $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

        if (!file_exists($url_insert)) {
            mkdir($url_insert, 0777, true);
        };

        if($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png" && $file_type != "gif" ) {
          echo "Solo se permiten imágenes tipo JPG, JPEG, PNG & GIF";
          $validar = 0;
        } 

        if($validar == 1){
            if (move_uploaded_file($url_temp, $url_target)) {
                echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";

            } else {
                echo "Ha habido un error al cargar tu archivo.";
            }
        }else{
            echo "Error: el archivo no se ha cargado";
        }

        $consulta = "INSERT INTO plantas(id_usuario, nombre, tipo, descripcion, imagen) VALUES('$id_usuario','$nombre','$tipo','$descripcion','$url_target')";

        $resultado = mysqli_query($conexion,$consulta);

        if ($resultado) {
            echo $url_target;
            header("Location: ../inicios/plantas.php");
        }else{
            echo "error";
        }
    }else{
        echo "no has completado los campos correctamente";
    }
}   

?>