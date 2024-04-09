<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$descripcion = $_POST['descripcion'];
$temporal_imagen = $_FILES['imagen']['tmp_name'];
$image = base64_encode(file_get_contents(addslashes($temporal_imagen)));


$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $stmt = $conexion->prepare("INSERT INTO plantas(id_usuario, nombre, tipo, descripcion, imagen) VALUES (?,?,?,?,?)");
    $stmt->bind_param("issss", $id_usuario, $nombre, $tipo, $descripcion, $image);
    $stmt->execute();
    header("Location: /proyectos/garden_os/plantas");
}else{
    echo "Algo salio mal con tu sesión";
}

$stmt->close();
$conexion->close();
?>