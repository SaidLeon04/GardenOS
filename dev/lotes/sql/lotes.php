<?php 
    $lote_usuario = "SELECT * FROM lote WHERE id_usuario = ?";

    $lote_one = "SELECT plantas.nombre, plantas.imagen, lote.nombre_lote, lote.fecha_inicial, lote.cantidad_actual FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta WHERE plantas.id_usuario = ? AND id_lote=?";

    $insert_lote = "INSERT INTO lote(id_planta, nombre_lote, fecha_inicial, cantidad_inicial, cantidad_actual, estado, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $planta_usuario = "SELECT * FROM plantas WHERE id_usuario = ? AND id_planta = ?";

    $borrar_lote = "DELETE FROM lote WHERE id_lote = ?";
?>