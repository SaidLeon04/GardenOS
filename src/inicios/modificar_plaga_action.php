<?php
	include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['nombre'])> 0) {
        $id_plaga = $_POST['id_plaga'];
        $nombre = $_POST['nombre'];
        $id_lote = $_POST['id_lote'];
        $tratamiento = $_POST['tratamiento'];
        $afectaciones = $_POST['afectaciones'];
        $causas = $_POST['causas'];

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

        $consulta = "UPDATE plagas SET nombre_plaga='$nombre', tratamiento='$tratamiento', afectaciones = '$afectaciones', causas = '$causas', imagen_plaga='$url_target' WHERE id_plaga = '$id_plaga'";

        $resultado = mysqli_query($conexion,$consulta);

        if ($resultado) {
            header("Location: ../inicios/plagas.php");
        }else{
            echo "error";
        }
    }else{
        echo "no has completado los campos correctamente";
    }
}  

?>