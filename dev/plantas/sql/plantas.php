<?php 
    $consulta_usuario = "SELECT * FROM usuarios WHERE id_usuario = ?";

    $insert_planta = "INSERT INTO plantas(id_usuario, nombre, tipo, descripcion, imagen) VALUES (?,?,?,?,?)";

?>