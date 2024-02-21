<?php
	include("../conexion.php");


if(isset($_POST['eliminar'])){
    $id_lote = $_POST['id_lote'];
    $nombre_lote = $_POST['nombre_lote'];
    $validez_nombre = FALSE;


    $consulta_nombre_lote = "SELECT nombre_lote FROM lote WHERE nombre_lote = '$nombre_lote'";
    $resultado_nombre_lote = mysqli_query($conexion, $consulta_nombre_lote); 
    while ($row = $resultado_nombre_lote -> fetch_array()){
        $row['nombre_lote'];
        $validez_nombre = TRUE;
        }
    if($validez_nombre){
        $consulta_riegos = "DELETE  FROM riego WHERE id_lote = '$id_lote'";
        $consulta_temperatura = "DELETE  FROM temperatura WHERE id_lote = '$id_lote'";
        $consulta_humedad = "DELETE  FROM humedad WHERE id_lote = '$id_lote'";
        $consulta_iluminacion = "DELETE  FROM iluminacion WHERE id_lote = '$id_lote'";
        $consulta_poda = "DELETE  FROM poda WHERE id_lote = '$id_lote'";
        $consulta_cambio_tierra = "DELETE  FROM cambio_tierra WHERE id_lote = '$id_lote'";
        $consulta_historial = "DELETE  FROM historial WHERE id_lote = '$id_lote'";
        $consulta_crecimiento = "DELETE  FROM crecimiento WHERE id_lote = '$id_lote'";
        $consulta_plagas = "DELETE  FROM plagas WHERE id_lote = '$id_lote'";
        $consulta = "DELETE  FROM lote WHERE id_lote = '$id_lote'";

            

            $resultado_riegos = mysqli_query($conexion,$consulta_riegos);
            $resultado_temperatura = mysqli_query($conexion,$consulta_temperatura);
            $resultado_humedad = mysqli_query($conexion,$consulta_humedad);
            $resultado_iluminacion = mysqli_query($conexion,$consulta_iluminacion);
            $resultado_poda = mysqli_query($conexion,$consulta_poda);
            $resultado_cambio_tierra = mysqli_query($conexion,$consulta_cambio_tierra);
            $resultado_historial = mysqli_query($conexion,$consulta_historial);
            $resultado_crecimiento = mysqli_query($conexion,$consulta_crecimiento);
            $resultado_plagas = mysqli_query($conexion,$consulta_plagas);

            $resultado = mysqli_query($conexion,$consulta);

            if ($resultado && $resultado_riegos && $resultado_temperatura && $resultado_humedad && $resultado_iluminacion && $resultado_poda  && $resultado_cambio_tierra  && $resultado_historial &&  $resultado_crecimiento &&  $resultado_plagas) {
                header("Location: ../inicios/lotes.php"); 
            }else{
                echo "error";
            }
    }else{
        echo "El lote con el nombre ".$nombre_lote." no existe";
    }  
}       
?>