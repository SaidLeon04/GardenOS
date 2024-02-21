<?php
	include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['fecha'])> 0 && strlen($_POST['hora'])> 0 && strlen($_POST['humedad'])> 0) {
        $lote = $_POST['id_lote'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $humedad = $_POST['humedad'];
        
        $consulta = "INSERT INTO humedad(id_lote, fecha, hora, humedad) 
                    VALUES('$lote','$fecha','$hora','$humedad')";

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


if(isset($_POST['ahora'])){
    if (strlen($_POST['id_lote'])> 0 && strlen($_POST['humedad'])> 0) {
        $lote = $_POST['id_lote'];
        $humedad = $_POST['humedad'];

        $date = date('Y-m-d H:i:s', $time= time());
        $timestamp = strtotime($date);
        $fecha = date('Y-m-d', $timestamp);
        $hora = date('H:i:s', $timestamp); 
        $consulta = "INSERT INTO humedad(id_lote, fecha, hora, humedad) 
                    VALUES('$lote','$fecha','$hora','$humedad')";

        $resultado = mysqli_query($conexion,$consulta);

        if ($resultado) {
            header("Location: ../inicios/lotes.php");
        }else{
            echo "error";
        }
    }else{
        echo "No has completado los campos correctamente, recuerda que fecha y hora no deben ser llenados sin seleccionaste 'Fecha y hora actual'";
    }
}
?>