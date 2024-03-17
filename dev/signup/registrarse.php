<?php
    include("../conexion.php");

if(isset($_POST['registrar'])){
    if (strlen($_POST['nombre'])> 0 && strlen($_POST['correo'])> 0 && strlen($_POST['passwd'])> 0){
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $passwd = trim($_POST['passwd']);
        $hashedPassword = md5($passwd);
        $fecha = date("Y-m-d");
        
        
        $consulta = "INSERT INTO usuarios(nombre, correo, passwd, dias) VALUES('$nombre','$correo','$hashedPassword', '$fecha')";
        $resultado = mysqli_query($conexion,$consulta);
        if ($resultado) {
            header("Location: ../login/login.html");
        }else {
            echo "Error en la consulta SQL";
        }                      
    }else{
        echo "Error al recibir datos";
    }
}else{
    echo "Error en el envio del botón registrar";
}

?>