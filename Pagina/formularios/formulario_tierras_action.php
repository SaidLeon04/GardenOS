<?php
	include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['id_lote'])> 0 && strlen($_POST['fecha'])> 0 && strlen($_POST['textura'])> 0 && strlen($_POST['cantidad_tierra'])> 0 ) {
        $id_lote = $_POST['id_lote'];
        $fecha = $_POST['fecha'];
        $textura = $_POST['textura'];
        $cantidad_tierra = $_POST['cantidad_tierra'];
        
        $consulta = "INSERT INTO cambio_tierra(id_lote, fecha, textura, cantidad_tierra) VALUES('$id_lote','$fecha','$textura','$cantidad_tierra')";

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
    if (strlen($_POST['id_lote'])> 0 && strlen($_POST['textura'])> 0 && strlen($_POST['cantidad_tierra'])> 0) {
        $lote = $_POST['id_lote'];
        $textura = $_POST['textura'];
        $cantidad_tierra = $_POST['cantidad_tierra'];

        $date = date('Y-m-d H:i:s', $time= time());
        $timestamp = strtotime($date);
        $fecha = date('Y-m-d', $timestamp);
        $hora = date('H:i:s', $timestamp); 
        $consulta = "INSERT INTO cambio_tierra(id_lote, fecha, textura, cantidad_tierra) 
                    VALUES('$lote','$fecha','$textura','$cantidad_tierra')";

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