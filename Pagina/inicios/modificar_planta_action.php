<?php
	include("../conexion.php");


if(isset($_POST['actualizar'])){
      if (strlen($_POST['nombre'])> 0 && strlen($_POST['tipo'])> 0 && strlen($_POST['descripcion'])> 0) {
        $id_planta = $_POST['id_planta'];
        $nombre = trim($_POST['nombre']);
        $tipo = trim($_POST['tipo']);
        $descripcion = trim($_POST['descripcion']);

 $file = $_FILES["imagen"]["name"];
        $validar = 1;
        $file_type = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        $url_temp = $_FILES["imagen"]["tmp_name"];
        $url_insert = "../img"; 
        $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

        if (!file_exists($url_insert)) {
            mkdir($url_insert, 0777, true);
        };

        if($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png" && $file_type != "gif" && $file_type =="pdf" && $file_type =="mp4"  && $file_type=="mp3"  ) {
          echo "Solo se permiten imágenes tipo JPG, JPEG, JFIF, PNG & GIF";
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

        $consulta = "UPDATE plantas SET nombre='$nombre',tipo='$tipo', descripcion='$descripcion',imagen='$url_target' WHERE id_planta = '$id_planta'";

        $resultado = mysqli_query($conexion,$consulta);

        if ($resultado) {
            header("Location: ../inicios/plantas.php");
        }else{
            echo "error";
        }
    }else{
        echo "no has completado los campos correctamente";
    }
}  

?>