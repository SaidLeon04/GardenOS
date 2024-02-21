<?php
    include("../conexion.php");

if(isset($_POST['registrar'])){
    if (strlen($_POST['nombre'])> 0 && strlen($_POST['correo'])> 0 && strlen($_POST['passwd'])> 0 && strlen($_POST['passwd_r'])> 0){
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $passwd = trim($_POST['passwd']);
        $passwd_r = trim($_POST['passwd_r']);
        $hashedPassword = md5($passwd);
        
        if ($passwd == $passwd_r) {
            $consulta = "INSERT INTO usuarios(nombre, correo, passwd) VALUES('$nombre','$correo','$hashedPassword')";
            $resultado = mysqli_query($conexion,$consulta);
            if ($resultado) {
                header("Location: ../login/iniciar_sesion.html");
            }else {
                include("pass_diferente.html");
            }                      
    }else{
        include("campos_no_llenos.html");
    }
    }
}
?>