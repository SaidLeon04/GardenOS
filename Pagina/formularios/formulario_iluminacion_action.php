<?php
	include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['id_lote'])> 0 && strlen($_POST['fecha'])> 0 && strlen($_POST['situacion'])> 0) {
        $lote = $_POST['id_lote'];
        $fecha = $_POST['fecha'];
        $situacion = $_POST['situacion'];

        if ($situacion == 'noche') {
            $iluminacion = 0.02;
        }elseif ($situacion == 'noche/luna_llena') {
            $iluminacion = 0.6;
        }elseif ($situacion == 'nublado') {
            $iluminacion = 5;
        }elseif ($situacion == 'nublado_exterior') {
            $iluminacion = 50;
        }elseif ($situacion == 'dia_bajo_techo') {
            $iluminacion = 100;
        }elseif ($situacion == 'dia_soleado') {
            $iluminacion = 1000;
        }elseif ($situacion == 'atardecer') {
            $iluminacion = 400;
        }elseif ($situacion == 'habitacion') {
            $iluminacion = 150;
        }elseif ($situacion == 'habitacion_iluminada') {
            $iluminacion = 500;
        }
        
        $consulta = "INSERT INTO iluminacion(id_lote, fecha, situacion,iluminacion) VALUES('$lote','$fecha','$situacion','$iluminacion')";

        $resultado = mysqli_query($conexion,$consulta);

        if ($resultado) {
            header("Location: ../inicios/lotes.php");
        }else{
            echo "error";
        }
    }else{
        echo "no has completado los campos correctamente";
    }
}  

?>