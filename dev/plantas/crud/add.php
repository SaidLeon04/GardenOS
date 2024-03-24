<?php
include("../../conexion.php");
#TODO PLANTAS SQL actualizado en ADD

if(isset($_POST['guardar'])){
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $temporal_imagen = $_FILES['imagen']['tmp_name'];
    $image = base64_encode(file_get_contents(addslashes($temporal_imagen)));

    $stmt = $conexion->prepare("INSERT INTO plantas (id_usuario, nombre, tipo, descripcion, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id_usuario, $nombre, $tipo, $descripcion, $image);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../plantas.php");
    } else {
        echo "No se pudo insertar los datos.";
    }
}   
?>