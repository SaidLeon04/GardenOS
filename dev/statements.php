<?php
    $consulta_usuario = "SELECT * FROM usuarios WHERE id_usuario = ?";

    $consulta_planta = "SELECT * FROM plantas WHERE id_planta = ?";

    $consulta_lote = "SELECT * FROM lote WHERE id_lote = ?"; #TODO make id_usuario a row in lote table

    $borrar_planta = "DELETE FROM plantas WHERE id_planta = ?";

    $consulta_join = "SELECT plantas.id_planta, plantas.nombre, plantas.tipo, plantas.imagen, lote.id_lote, lote.id_sensor, lote.nombre_lote, lote.fecha_inicial, lote.cantidad_actual, lote.estado, lote.temperatura_optima, lote.humedad_optima FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta WHERE id_usuario = ? AND estado != 'finalizado' GROUP BY nombre_lote";

    $plantas_usuario = "SELECT * FROM plantas WHERE id_usuario = ?";

    $sensores_usuario = "SELECT * FROM sensores WHERE id_usuario = ?";
    
    $lote_usuario = "SELECT plantas.id_planta, plantas.nombre, plantas.tipo, plantas.imagen, lote.id_lote, lote.id_sensor, lote.nombre_lote, lote.fecha_inicial, lote.cantidad_actual, lote.estado, lote.temperatura_optima, lote.humedad_optima FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta WHERE id_usuario = ? AND id_lote = ?";

    $borrar_lote = "DELETE FROM lote WHERE id_lote = ?";

    $update_lote = "UPDATE lote SET nombre_lote = ?, cantidad_actual = ? WHERE id_lote = ?";

    $actualizar_valores_optimos = "UPDATE lote SET temperatura_optima = ?, humedad_optima = ? WHERE id_lote = ?";

?>