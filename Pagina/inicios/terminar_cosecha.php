<?php
	include("../conexion.php");

	if(isset($_POST['guardar'])){

        $id_lote = $_POST['id_lote'];
        $fecha_final = $_POST['fecha_final'];

        $consulta_lote;
 
        $consulta = "UPDATE lote SET nombre_lote='$nombre_lote',fecha='$fecha', estado='$estado',cantidad='$cantidad' WHERE id_lote = '$id_lote'";

        $resultado = mysqli_query($conexion,$consulta);

        if ($resultado) {
            header("Location: ../inicios/lotes.php");
        }else{
            echo "error";
        }
    }else{
        echo "no has completado los campos correctamente";
    }

?>