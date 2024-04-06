<?php
session_start();
session_destroy();
header("Location: http://localhost/proyectos/garden_os/sign_in");

?>