<?php
	include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['id_lote'])> 0 && strlen($_POST['fecha'])> 0 && strlen($_POST['hora'])> 0 && strlen($_POST['duracion'])> 0 && strlen($_POST['cantidad_agua'])> 0 && strlen($_POST['ph_agua'])> 0) {
        $id_lote = $_POST['id_lote'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $duracion = $_POST['duracion'];
        $cantidad_agua = $_POST['cantidad_agua'];
        $unidad = $_POST['unidad'];
        $ph_agua = $_POST['ph_agua'];
        
        if ($unidad == 'mililitros') {
            $cantidad_real = $cantidad_agua/1000;
        }elseif ($unidad == 'litros') {
            $cantidad_real = $cantidad_agua;
        }
        elseif ($unidad == 'galones') {
            $cantidad_real = $cantidad_agua* 3.785;
        }

        $consulta = "INSERT INTO riego(id_lote, fecha, hora, duracion,cantidad_agua,unidad,ph_agua) VALUES('$id_lote','$fecha','$hora','$duracion','$cantidad_real','$unidad','$ph_agua')";

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
    if (strlen($_POST['id_lote'])> 0 && strlen($_POST['duracion'])> 0 && strlen($_POST['cantidad_agua'])> 0 && strlen($_POST['ph_agua'])> 0) {
        $id_lote = $_POST['id_lote'];
        $duracion = $_POST['duracion'];
        $cantidad_agua = $_POST['cantidad_agua'];
        $unidad = $_POST['unidad'];
        $ph_agua = $_POST['ph_agua'];

        $date = date('Y-m-d H:i:s', $time= time());
        $timestamp = strtotime($date);
        $fecha = date('Y-m-d', $timestamp);
        $hora = date('H:i:s', $timestamp); 
        $consulta = "INSERT INTO riego(id_lote, fecha, hora, duracion,cantidad_agua,unidad,ph_agua) 
                    VALUES('$id_lote','$fecha','$hora','$duracion','$cantidad_agua','$unidad','$ph_agua')";

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