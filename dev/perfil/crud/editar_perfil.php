<?php 

include("../../conexion.php");
include("../../statements.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$temporal_imagen = $_FILES['imagen']['tmp_name'];
$image = base64_encode(file_get_contents(addslashes($temporal_imagen)));
$existe = false;

$stmt = $conexion->prepare($consulta_usuario);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->store_result(); 

if ($stmt->num_rows > 0){
    $existe = true;
}else{
    echo "El usuario no existe";
}

# TODO actualizar todo? o solo los campos que se quieren cambiar?
if($existe){
    $stmt = $conexion->prepare($update_usuario);
    $stmt->bind_param("sssi", $nombre, $correo, $image, $id_usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../view_perfil.php");
    } else {
        echo "No se realizaron cambios.";
    }
}

session_unset();
session_destroy();

$stmt->close();
$conexion->close();
header("Location: ../../login/login.html")
    
?>