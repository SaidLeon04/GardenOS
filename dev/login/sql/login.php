<?php
    $login_nombre = "SELECT id_usuario, nombre FROM usuarios WHERE nombre = ? AND passwd = ?";

    $login_correo = "SELECT id_usuario, nombre, correo FROM usuarios WHERE correo = ? AND passwd = ?";
?>