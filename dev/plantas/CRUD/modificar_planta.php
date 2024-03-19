<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Planta</title>
    <link rel="stylesheet" href="css/modificar_planta.css">
    <link rel="stylesheet" href="../../assets/css/barra_lateral.css">
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
                            $nombre = $_GET['nombre'];
                            $descripcion = $_GET['descripcion'];
                            $imagen = $_GET['imagen'];
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

<!-- TODO mejorar formularios -->
<section class="home"> 
    <div class="container">
        <h1>MODIFICAR PLANTA</h1>  
        <form action="modificar_planta_action.php" method="POST" enctype="multipart/form-data">
            <input text="text" name="id_planta" value="<?php echo $id_planta ?>" hidden>
            <input type="text" name="nombre" placeholder="Nombre Planta" value="<?php echo $nombre ?>">
            <select name="tipo">
                <option value="Hortaliza">Hortaliza</option>
                <option value="Ornato">Ornato</option> 
            </select>
            <input type="text" placeholder="Descripción" name="descripcion" value="<?php echo $descripcion; ?>">
            <input type="file" name="imagen">
            <input type="submit" value="Actualizar" name="actualizar">
        </form>
    </div>
</section>
</body>
<script src="../../assets/js/barra_lateral.js"></script>
</html>

