<?php
include("../../conexion.php");

session_start();
$id_usuario = $_SESSION['id_usuario'];
$usuario = $_SESSION['nombre'];
$passwd = $_POST['passwd'];
$new_passwd = $_POST['new_passwd'];
$new_passwdr = $_POST['new_passwdr'];
$existe = false;

if ($new_passwd == $new_passwdr) {
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $existe = true;
        $hash_passwd = md5($passwd);
        $stmt = $conexion->prepare("SELECT passwd FROM usuarios WHERE id_usuario = ? AND passwd = ?");
        $stmt->bind_param("is", $id_usuario, $hash_passwd);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $hash_new_passwd = md5($new_passwd);
            $stmt = $conexion->prepare("UPDATE usuarios SET passwd = ? WHERE id_usuario = ?");
            $stmt->bind_param("si", $hash_new_passwd, $id_usuario);
            $stmt->execute();
            if ($stmt->affected_rows > 0){
                session_unset();
                session_destroy();
                $stmt->close();
                $conexion->close();
                header("Location: /proyectos/garden_os/login");

            }else{
                echo "No se realizaron cambios";
            }

        } else {
            echo "La contraseña actual no coincide ¿Olvidaste tu contraseña?";
        }
    } else {
        echo "El usuario no existe";
    }
}else{
    echo "Las contraseñas no coinciden";
}


?>