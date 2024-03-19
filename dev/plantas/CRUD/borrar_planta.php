<!DOCTYPE html>
<html>
<head lang="es">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Planta</title>
    <link rel="stylesheet" href="../../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="css/borrar_planta.css">
</head>
<body>

<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../../assets/img/clean.png" alt="pfp.jpg">
                </span>

                <div class="text logo-text">
                    <span class="name">
                        <?php 
                            include("../../conexion.php");
                            session_start();
                            $id_usuario = $_SESSION['id_usuario'];
                            $usuario = $_SESSION['nombre'];
				            echo $usuario;
                            $id_planta = $_GET['id_planta'];
                        ?>
                    </span>
                </div>
            </div>
                <img src="../../assets/svg/arrow.svg" alt="icono_arrow" class="toggle">
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="../../home/home.php" title="Volver al inicio">
                            <img src="../../assets/svg/home.svg" alt="icono_home" class="icon">
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../plantas.php" title="Ver catálogo de plantas">
                            <img src="../../assets/svg/planta.svg" alt="icono_planta" class="icon">
                            <span class="text nav-text">Plantas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../../lotes/lotes.php">
                            <img src="../../assets/svg/lotes.svg" alt="icono_lotes" class="icon">
                            <span class="text nav-text">Lotes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../../lotes_terminados/lotes_terminados.php">
                            <img src="../../assets/svg/lotes_terminados.svg" alt="icono_lotes" class="icon">
                            <span class="text nav-text">Lotes Terminados</span>
                        </a>
                    </li>  

                    <li class="nav-link">
                        <a href="../../zen/zen.php">
                            <img src="../../assets/svg/zen.svg" alt="icono_zen" class="icon">
                            <span class="text nav-text">
                                Zen
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <a href="../../ayuda/ayuda.php">
                        <img src="../../assets/svg/help.svg" alt="icono_help" class="icon">
                        <span class="text nav-text">Ayuda</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="../../logout/logout.php">
                        <img src="../../assets/svg/logout.svg" alt="icono_logout" class="icon">
                        <span class="text nav-text">Salir</span>
                    </a>
                </li>
            </div>

        </div>
</nav>

<div class="container">
    <h1>Eliminar Planta</h1>
    <form action="borrar_planta_action.php" method="POST">
        <input type="number" name="id_planta" readonly value="<?php echo $id_planta?>" hidden>
        <input type="text" name="nombre_planta" placeholder="Nombre de la planta">
        <label>Esta acción eliminará definitivamente una planta.</label><br><br>
        <label>No puedes realizar esta acción si la planta existe en un lote</label><br><br>
        <input type="submit" name="eliminar" value="Eliminar" onclick="return eliminarPlanta()">
    </form>
</div>
</body>
<script src="../../assets/js/barra_lateral.js"></script>
<script src="js/borrar_planta.js"></script>
</html>
