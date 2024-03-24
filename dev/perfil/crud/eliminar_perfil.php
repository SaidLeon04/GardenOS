<?php
include("../../conexion.php");
include("../../statements.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$nombre = $_POST['nombre'];
$passwd = $_POST['passwd'];
$hash_passwd = md5($passwd);

$stmt = $conexion->prepare($consulta_usuario);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0){
    $stmt = $conexion->prepare($consulta_passwd);
    $stmt->bind_param("is", $id_usuario, $hash_passwd);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0){
        $stmt = $conexion->prepare($borrar_usuario);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        session_unset();
        session_destroy();

        $stmt->close();
        $conexion->close();
        header("Location: ../../login/login.html");
    } else {
        echo "Los datos enviados son incorrectos.";
    }
} else {
    echo "El usuario no existe";

}
?>