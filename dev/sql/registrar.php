<?php
$email_query = "SELECT * FROM usuarios WHERE correo = ?";

$name_query = "SELECT * FROM usuarios WHERE nombre = ?";

$insert_query = "INSERT INTO usuarios (nombre, correo, passwd, dias, imagen) VALUES (?, ?, ?, ?, ?)";
?>