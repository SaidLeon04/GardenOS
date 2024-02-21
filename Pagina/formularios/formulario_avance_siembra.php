    <form action="formulario_avance_action.php" method="POST">
        <input type="text" name="id_lote" hidden readonly value="<?php echo $id_lote; ?>">
        <label>Lote</label>
        <input type="text" name="nombre_lote" readonly value="<?php echo $nombre_lote; ?>">
        <label>Estado Actual</label>

    <div style="display: inline-flex;">
        <input type="text" name="estado" readonly value="<?php echo $estado;?>">
        <input type="text" name="cantidad" readonly value="<?php echo $cantidad; ?>">
   </div>
        <input type="text" name="fecha_inicio" readonly value="<?php echo $fecha_inicio;?>">
        
        
        <label>Siguiente Paso</label>

        <div style="display: inline-flex;">
        <input type="text" name="estado_nuevo" readonly value="<?php echo $estado_nuevo; ?>">
        <input type="date" placeholder="Fecha" min="<?php echo $fecha_inicio ?>" max="2100-12-12" name="fecha_estado">
    </div>
        <input type="number" placeholder="Cantidad" name="cantidad_nuevo" min="1" max="<?php echo $cantidad?>">
        <input type="submit" value="Guardar" name="guardar">
    </form>