<?php
include("../conexion.php");
    
if(isset($_REQUEST['guardar'])){
    $id_planta = $_POST['id_planta'];
    $nombre_lote = $_POST['nombre_lote'];
    $fecha = $_POST['fecha'];
    $cantidad = $_POST['cantidad'];
    $estado = $_POST['estado'];
    
    $stmt = $conexion->prepare("INSERT INTO lote(id_planta, nombre_lote, fecha_inicial, cantidad_inicial, cantidad_actual, estado) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiis", $id_planta, $nombre_lote, $fecha, $cantidad, $cantidad, $estado);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: lotes.php");
    } else {
        echo "No se pudo insertar los datos.";
    }
}
# TODO el historial se generaba cuando se creaba el lote, waos
?>