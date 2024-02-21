<?php
	include("../conexion.php");


if(isset($_POST['guardar'])){
      if (strlen($_POST['id_lote'])> 0 && strlen($_POST['fecha'])> 0 && strlen($_POST['medidas'])> 0 && strlen($_POST['unidad'])> 0) {
        $id_lote = $_POST['id_lote'];
        $fecha = $_POST['fecha'];
        $medidas = $_POST['medidas'];
        $divisor = $_POST['divisor'];
        $unidad = $_POST['unidad'];

        $medida = $medidas/$divisor;
        if ($unidad == "mm") {
            $medida_cm = $medida/10;
        }elseif ($unidad == "cm") {
            $medida_cm = $medida;
        }elseif($unidad = "m"){
            $medida_cm = $medida*100;
        }
        
        $consulta = "INSERT INTO crecimiento(id_lote, fecha, medida) VALUES('$id_lote','$fecha','$medida_cm')";

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