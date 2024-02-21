<?php
	#riegos
	$agua = 0;
	$duracion = 0;
	$ph = 0;
	$contador_riego = "SELECT count(id_lote) AS contador FROM riego WHERE id_lote = '$id_lote'";
	$resultado_contador_riego = mysqli_query($conexion,$contador_riego);
	while ($row = $resultado_contador_riego->fetch_array()) {
		$contador = $row['contador'];
	}

	$consulta_riego = "SELECT * FROM riego WHERE id_lote = '$id_lote' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
    $resultado_riego = mysqli_query($conexion, $consulta_riego);
        while ($row = $resultado_riego->fetch_array()) {       
			$duracion += $row['duracion'];

			$agua += $row['cantidad_agua'];
			$row['unidad'];
			$ph += $row['ph_agua'];
        }




    #temperatura
    $temperatura_promedio = 0;
    $temperatura_count = 0;
    $contador_temperatura = "SELECT count(id_lote) AS contador FROM temperatura WHERE id_lote = '$id_lote'";
	$resultado_contador_temperatura = mysqli_query($conexion,$contador_temperatura);
	while ($row = $resultado_contador_temperatura->fetch_array()){
		$contador = $row['contador'];
	}
	$consulta_temperatura = "SELECT * FROM temperatura WHERE id_lote = '$id_lote' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
    $resultado_temperatura = mysqli_query($conexion, $consulta_temperatura);
    while ($row = $resultado_temperatura->fetch_array()) { 
    	$temperatura_count += $row['temperatura'];
    }
    if ($temperatura_count != 0) {
    	$temperatura_promedio = $temperatura_count/$contador;
    }


    #humedad
    $humedad_promedio = 0;
    $humedad_count = 0;
    $contador_humedad = "SELECT count(id_lote) AS contador FROM humedad WHERE id_lote = '$id_lote'";
	$resultado_contador_humedad = mysqli_query($conexion,$contador_humedad);
	while ($row = $resultado_contador_humedad->fetch_array()){
		$contador = $row['contador'];
	}
	$consulta_humedad = "SELECT * FROM humedad WHERE id_lote = '$id_lote' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
    $resultado_humedad = mysqli_query($conexion, $consulta_humedad);
    while ($row = $resultado_humedad->fetch_array()) { 
    	$humedad_count += $row['humedad'];
    }
    if ($humedad_count != 0) {
    	$humedad_promedio = $humedad_count/$contador;    
    }



    #iluminacion
    $promedio_iluminacion = 0;
    $iluminacion_count = 0;

    $contador_iluminacion = "SELECT count(id_lote) AS contador FROM iluminacion WHERE id_lote = '$id_lote'";
	$resultado_contador_iluminacion = mysqli_query($conexion,$contador_iluminacion);
	while ($row = $resultado_contador_iluminacion->fetch_array()){
		$contador = $row['contador'];
	}

	$consulta_iluminacion = "SELECT * FROM iluminacion WHERE id_lote = '$id_lote' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
    $resultado_iluminacion = mysqli_query($conexion, $consulta_iluminacion);
    while ($row = $resultado_iluminacion->fetch_array()) { 
    	$iluminacion_count += $row['iluminacion'];
    }
    if ($iluminacion_count != 0) {
   		$promedio_iluminacion = $iluminacion_count/$contador;
    }


    $consulta_iluminacion_situacion = "SELECT situacion, COUNT(situacion) AS repeticiones FROM iluminacion GROUP BY situacion ORDER BY repeticiones DESC LIMIT 1";
    $resultado_iluminacion_situacion = mysqli_query($conexion,$consulta_iluminacion_situacion);
    while ($row = $resultado_iluminacion_situacion -> fetch_array()) {
    	$situacion_promedio = $row['situacion'];
    }


    #tierra
    $promedio_cambio_tierra = 0;
    $cambio_tierra_count = 0;

    $contador_cambio_tierra = "SELECT count(id_lote) AS contador FROM cambio_tierra WHERE id_lote = '$id_lote'";
	$resultado_contador_cambio_tierra = mysqli_query($conexion,$contador_cambio_tierra);
	while ($row = $resultado_contador_cambio_tierra->fetch_array()){
		$contador = $row['contador'];
	}

	$consulta_cambio_tierra = "SELECT * FROM cambio_tierra WHERE id_lote = '$id_lote' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
    $resultado_cambio_tierra = mysqli_query($conexion, $consulta_cambio_tierra);
    while ($row = $resultado_cambio_tierra->fetch_array()) { 
    	$cambio_tierra_count += $row['cantidad_tierra'];
    }
    if ($cambio_tierra_count != 0) {
   		$promedio_cambio_tierra = $cambio_tierra_count/$contador;
    }


    /*$consulta_cambio_tierra_textura = "SELECT textura, COUNT(textura) AS repeticiones FROM cambio_tierra GROUP BY textura ORDER BY repeticiones DESC LIMIT 1";
    $resultado_cambio_tierra_textura = mysqli_query($conexion,$consulta_cambio_tierra_textura);
    while ($row = $resultado_cambio_tierra_textura->fetch_array()) {
    	$textura_promedio = $row['textura'];
    }*/


    #poda 
    $contador_poda = "SELECT count(id_lote) AS contador FROM poda WHERE id_lote = '$id_lote' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
	$resultado_poda = mysqli_query($conexion,$contador_poda);
	while ($row = $resultado_poda->fetch_array()){
		$contador_poda_num = $row['contador'];
	}


	#crecimiento
			$promedio_crecimiento = 0;
			$contador_crecimiento = 0;
            $sum_crecimiento = 0;
            $consulta_crecimiento = "SELECT count(id_lote) AS contador FROM crecimiento WHERE id_lote = '$id_lote' AND fecha BETWEEN '$fecha1' AND '$fecha2'";
            $resultado_consulta_crecimiento = mysqli_query($conexion,$consulta_crecimiento);
            while ($row = $resultado_consulta_crecimiento -> fetch_array()) {
                 $contador_crecimiento += $row['contador'];
            }

            $consulta_suma_crecimiento = "SELECT medida FROM crecimiento WHERE id_lote = '$id_lote'";
            $resultado_consulta_suma_crecimiento = mysqli_query($conexion,$consulta_suma_crecimiento);
            while($row = $resultado_consulta_suma_crecimiento -> fetch_array()){
                $sum_crecimiento += $row['medida'];
            }
            if($contador_crecimiento !=0){
                $promedio_crecimiento = $sum_crecimiento/$contador_crecimiento;
            } 
?>