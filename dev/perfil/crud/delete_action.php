<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$nombre = $_POST['nombre'];
$passwd = $_POST['passwd'];
$hash_passwd = md5($passwd);

$stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0){
    $stmt = $conexion->prepare("SELECT passwd FROM usuarios WHERE id_usuario = ? AND passwd = ?");
    $stmt->bind_param("is", $id_usuario, $hash_passwd);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0){
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        session_unset();
        session_destroy();

        $stmt->close();
        $conexion->close();
        header("Location: /proyectos/garden_os/login");
    } else {
        echo "Los datos enviados son incorrectos.";
    }
} else {
    echo "El usuario no existe";

}
?>