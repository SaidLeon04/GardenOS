<?php
    $consulta_planta = "SELECT * FROM plantas WHERE id_planta = ?";

    $consulta_lote = "SELECT * FROM lote WHERE id_planta = ?";

    $borrar_planta = "DELETE FROM plantas WHERE id_planta = ?";

?>