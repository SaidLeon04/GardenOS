<?php
include("../../conexion.php");
include("../../statements.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$usuario = $_SESSION['nombre'];
$correo = $_POST['correo'];
$new_email = $_POST['new_email'];
$new_emailr = $_POST['new_emailr'];
$existe = false;

if ($new_email == $new_emailr) {
    $stmt = $conexion->prepare($consulta_usuario);
    $stmt->bind_param('i', $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $existe = true;
    } else {
        echo "El usuario no existe";
    }

    if ($existe) {
        $stmt = $conexion->prepare($update_correo);
        $stmt->bind_param('si', $new_email, $id_usuario);
        
        session_unset();
        session_destroy();
        $stmt->close();
        $conexion->close();
        header("Location: ../../login/login.html");
        
    } else {
        echo "Error en la update_correo";
    }
} else {
    echo "Los correos no coinciden";
}


$conexion->close();



?>