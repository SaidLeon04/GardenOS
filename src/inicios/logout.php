<?php
    session_start();
    session_destroy();
    header ("Location: ../login/iniciar_sesion.html");
?>