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

        $consulta_existencia = "SELECT id_lote FROM plagas WHERE id_lote = '$id_lote'";
        $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
        if ($resultado_existencia){
            echo "El lote seleccionado ya ha sido detectado con esta plaga";
        }else{
             $consulta_imagen = "SELECT imagen FROM plagas WHERE id_plaga = '$id_plaga'";
            $resultado_imagen = mysqli_query($conexion,$consulta_imagen);
            while ($row = $resultado_imagen->fetch_array()) {
                $url_target = $row['imagen'];
            }
            
            $consulta = "INSERT INTO plagas (nombre, id_lote, tratamiento, afectaciones, causas, imagen) VALUES('$nombre', '$id_lote', '$tratamiento', '$afectaciones', '$causas', '$url_target')";

            $resultado = mysqli_query($conexion,$consulta);

            if ($resultado) {
                header("Location: ../inicios/plagas.php");
                }else{
                    echo "error";
            }
    }
}
    else{
        echo "no has completado los campos correctamente";
    }
}

       

?>