<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$usuario = $_SESSION['nombre'];
$correo = $_POST['correo'];
$new_email = $_POST['new_email'];
$new_emailr = $_POST['new_emailr'];

if ($new_email == $new_emailr) {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param('i', $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $stmt = $conexion->prepare("UPDATE usuarios SET correo = ? WHERE id_usuario = ?");
        $stmt->bind_param('si', $new_email, $id_usuario);
        $stmt->execute();
        if ($stmt->affected_rows > 0){
            session_unset();
            session_destroy();
            $stmt->close();
            $conexion->close();
            header("Location: ../../login/login.html");
        } else {
            echo "No se realizaron cambios";
        }    
    } else {
        echo "El usuario no existe";
    }

} else {
    echo "Los correos no coinciden";
}
$conexion->close();

?>