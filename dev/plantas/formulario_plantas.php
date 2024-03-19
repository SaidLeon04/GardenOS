<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tus Plantas</title>
    <link rel="stylesheet" href="../assets/css/barra_lateral.css"> 
    <link rel="stylesheet" href="CRUD/css/formulario_plantas.css">
</head>
<body>
<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../assets/img/clean.png" alt="pfp.jpg">
                </span>

                <div class="text logo-text">
                    <span class="name">
                        <?php 
                            include("../conexion.php");
                            session_start();
                            $id_usuario = $_SESSION['id_usuario'];
                            $usuario = $_SESSION['nombre'];
				            echo $usuario;
                        ?>
                    </span>
                </div>
            </div>
                <img src="../assets/svg/arrow.svg" alt="icono_arrow" class="toggle">
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="home.php" title="Volver al inicio">
                            <img src="../assets/svg/home.svg" alt="icono_home" class="icon">
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../plantas/plantas.php" title="Ver catálogo de plantas">
                            <img src="../assets/svg/planta.svg" alt="icono_planta" class="icon">
                            <span class="text nav-text">Plantas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../lotes/lotes.php">
                            <img src="../assets/svg/lotes.svg" alt="icono_lotes" class="icon">
                            <span class="text nav-text">Lotes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../lotes_terminados/lotes_terminados.php">
                            <img src="../assets/svg/lotes_terminados.svg" alt="icono_lotes" class="icon">
                            <span class="text nav-text">Lotes Terminados</span>
                        </a>
                    </li>  

                    <li class="nav-link">
                        <a href="../zen/zen.php">
                            <img src="../assets/svg/zen.svg" alt="icono_zen" class="icon">
                            <span class="text nav-text">
                                Zen
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <a href="../ayuda/ayuda.php">
                        <img src="../assets/svg/help.svg" alt="icono_help" class="icon">
                        <span class="text nav-text">Ayuda</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="../logout/logout.php">
                        <img src="../assets/svg/logout.svg" alt="icono_logout" class="icon">
                        <span class="text nav-text">Salir</span>
                    </a>
                </li>
            </div>

        </div>
    </nav>
 <section class="home">
    <div class="container">
            <h1>PLANTAS</h1>
        <form action="formulario_plantas_action.php" method="POST" enctype="multipart/form-data">
            <input type="text" value="<?php echo $_SESSION['id_usuario'] ?>" hidden name="id_usuario" required>
            <input type="text" placeholder="Nombre planta" name="nombre" required><br>
            <select name="tipo" required>
                <option value="Hortaliza">Hortaliza</option>
                <option value="Ornato">Ornato</option> 
            </select>
                <input type="text" placeholder="Descripción" name="descripcion" required>
                <input type="file" name="imagen">
                <input type="submit" value="Guardar" name="guardar">
        </form>
    </div> 
</section>
</body>
<script src="../assets/js/barra_lateral.js"></script>
</html>

