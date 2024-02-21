<?php 
    $consulta_fecha = "SELECT * FROM historial WHERE id_lote = '$id_lote' AND estado = 'siembra'";
    $resultado_consulta_fecha = mysqli_query($conexion,$consulta_fecha);
    while ($row = $resultado_consulta_fecha -> fetch_array()) {
        $fecha_estado = $row['fecha'];
        $cantidad_anterior = $row['cantidad'];
    }

?>
<div class="container">
    <h1>Siguiente Paso: Crecimiento</h1>
    <p>Siembra directamente tus semillas</p>
    <form action="formulario_avance_action.php" method="POST">
        <input type="text" name="id_lote" hidden readonly value="<?php echo $id_lote; ?>">
        <label>Lote</label>
        <input type="text" name="nombre_lote" readonly value="<?php echo $nombre_lote; ?>">
        <label>Estado Actual</label>

    <div style="display: inline-flex;">
        <input type="text" name="estado" readonly value="<?php echo $estado;?>">
        <input type="text" name="cantidad" readonly value="<?php echo $cantidad_anterior; ?>">
   </div>
        <input type="text" name="fecha_inicio" readonly value="<?php echo $fecha_estado;?>">
        
        
        <label>Siguiente Paso</label>

        <div style="display: inline-flex;">
        <input type="text" name="estado_nuevo" readonly value="<?php echo $estado_nuevo; ?>">
        <input type="date" placeholder="Fecha" min="<?php echo $fecha_estado ?>" max="2100-12-12" name="fecha_estado">
    </div>
        <input type="number" placeholder="Cantidad inicial de este paso" name="cantidad_nuevo" min="1" max="<?php echo $cantidad_anterior?>">
        <input type="submit" value="Guardar" name="guardar">
    </form>