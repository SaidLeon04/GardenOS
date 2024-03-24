<?php
include("../conexion.php");
include("../sql/registrar.php");

if (strlen($_POST['nombre'])> 0 && strlen($_POST['correo'])> 0 && strlen($_POST['passwd'])> 0 && strlen($_POST['passwd_r'])> 0 && strlen($_FILES['imagen']['name'])> 0){
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $passwd = trim($_POST['passwd']);
    $passwd_r = trim($_POST['passwd_r']);
    $hashedPassword = md5($passwd);
    $fecha = date("Y-m-d");
    $temporal_imagen = $_FILES['imagen']['tmp_name'];
    $image = base64_encode(file_get_contents(addslashes($temporal_imagen)));
        
    
    if ($passwd == $passwd_r){
        $stmt = $conexion->prepare($email_query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "El correo ya está registrado";
        }else{
            $stmt = $conexion->prepare($name_query);
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "El nombre ya está registrado";
            }else{
                $stmt = $conexion->prepare($insert_query);
                $stmt->bind_param("sssss", $nombre, $correo, $hashedPassword, $fecha, $image);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    header("Location: ../login/login.html");
                } else {
                    echo "No se pudo insertar los datos.";
                }
            
            }
        }
    }else{
        echo "Las contraseñas no coinciden";
    }
}else{
    echo "Faltan datos";
}

?>