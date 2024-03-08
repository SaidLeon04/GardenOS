<?php
include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['nombre'])> 0 && strlen($_POST['id_lote'])> 0 && strlen($_POST['tratamiento'])> 0 && strlen($_POST['afectaciones'])> 0 && strlen($_POST['causas'])> 0) {
        $nombre = trim($_POST['nombre']);
        $id_lote = trim($_POST['id_lote']);
        $tratamiento = trim($_POST['tratamiento']);
        $afectaciones = trim($_POST['afectaciones']);
        $causas = trim($_POST['causas']);
        $peligro = $_POST['peligro'];
 
        # imagen
        $file = $_FILES["imagen"]["name"];
        $validar = 1;
        $file_type = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        $url_temp = $_FILES["imagen"]["tmp_name"];
        $url_insert = "../img"; 
        $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;
        echo $url_target;

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

        $consulta = "INSERT INTO plagas(nombre_plaga, id_lote, tratamiento, afectaciones, causas, peligro, imagen_plaga) VALUES('$nombre','$id_lote','$tratamiento','$afectaciones','$causas','$peligro','$url_target')";

        $resultado = mysqli_query($conexion,$consulta);

        if ($resultado) {
            echo $url_target;
            header("Location: ../inicios/plagas.php");
        }else{
            echo "error";
        }
    }else{
        echo "no has completado los campos correctamente";
    }
}   

?>