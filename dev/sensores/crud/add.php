<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$lote = $_POST['lote'];
$url_conexion = $_POST['url_conexion'];

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt = $conexion->prepare("SELECT * FROM lote WHERE id_lote = ?");
    $stmt->bind_param("i", $lote);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt = $conexion->prepare("INSERT INTO sensores (id_usuario, id_lote, nombre, tipo, url_conexion) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $id_usuario, $lote, $nombre, $tipo, $url_conexion);
        $stmt->execute();
        if ($stmt->affected_rows > 0){
            $stmt = $conexion->prepare("SELECT id_sensor, id_lote FROM sensores WHERE nombre = ?");
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $id_sensor = $row['id_sensor'];
                $id_lote = $row['id_lote'];
                $stmt = $conexion->prepare("UPDATE lote SET id_sensor = ? WHERE id_lote = ?");
                $stmt->bind_param("ii", $id_sensor, $id_lote);
                $stmt->execute();
                if ($stmt->affected_rows > 0){
                    $stmt->close();
                    $conexion->close();
                    header("Location: /proyectos/garden_os/sensores");
                }else{
                    echo "No se pudo agregar el sensor al lote";
                }
            }else{
                echo "idfk";
            }
        }else{
            echo "Error al insertar el sensor";
        }
    } else {
        echo "El lote no existe";
    }
} else {
    echo "El usuario no existe";
}
?>