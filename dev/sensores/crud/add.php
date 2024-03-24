<?php
include("../../conexion.php");
include("../../statements.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$usuario = $_SESSION['nombre'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$lote = $_POST['lote'];
$url_conexion = $_POST['url_conexion'];

$stmt = $conexion->prepare($consulta_usuario);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt = $conexion->prepare($consulta_lote);
    $stmt->bind_param("i", $lote);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt = $conexion->prepare("INSERT INTO sensores (id_usuario, id_lote, nombre, tipo, url_conexion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $id_usuario, $lote, $nombre, $tipo, $url_conexion);
        $stmt->execute();
        header("Location: ../../sensores/sensores.php");
    } else {
        echo "El lote no existe";
    }
} else {
    echo "El usuario no existe";
}

$stmt->close();
$conexion->close();

?>