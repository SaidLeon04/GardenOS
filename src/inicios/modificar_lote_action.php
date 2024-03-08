<?php
	include("../conexion.php");


if(isset($_POST['actualizar'])){

        $id_lote = $_POST['id_lote'];
        $nombre_lote = $_POST['nombre_lote'];

        $consulta = "UPDATE lote SET nombre_lote='$nombre_lote' WHERE id_lote = '$id_lote'";

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