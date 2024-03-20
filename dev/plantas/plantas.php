<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, init-scale=1.0">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="../assets/css/btn_mas.css">
    <link rel="stylesheet" href="CRUD/css/plantas.css">
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
                        <a href="../home/home.php" title="Volver al inicio">
                            <img src="../assets/svg/home.svg" alt="icono_home" class="icon">
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="plantas.php" title="Ver catálogo de plantas">
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
                        <a href="../sensores/sensores.php">
                            <img src="../assets/svg/humedad.svg" alt="icono_humedad" class="icon">
                            <span class="text nav-text">
                                Sensores
                            </span>
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
    <div class="text">
        <header>
            Catalogo de plantas
                <?php 
                    echo "de:<strong> ". $_SESSION['nombre']."</strong>"; 
                ?>
            </header>
            <a href="formulario_plantas.php">
                <button class="btn_mas">+</button>
            </a> 
        </div>
        <?php
            include("../conexion.php");

            $query = "SELECT * FROM plantas WHERE id_usuario = $id_usuario";
            $resultado = mysqli_query($conexion,$query);
       ?>
    <center>
        <div>
            <?php
                while ($row = $resultado->fetch_array()) {
                echo '<table>';
                        echo '<tr><td colspan = "3"><img height="250px" width="250px" src="data:image;base64,' . $row['imagen'] . '" alt="imagen.jpg"/></td></tr>';
                        echo '<tr class = "datos"><td colspan = "3"><h5>' . $row["tipo"] . '</h5>';
                        echo '<h3>' . $row["nombre"] .'</h3></td></tr>';
                        echo '<tr class = "descripcion"><td colspan = "3"><div class="scroll">' . $row["descripcion"] . '</tr></td>';
                        echo '<tr class = "links">
                                <td>
                                    <a href="../lotes/formulario_lote.php?
                                        nombre_planta='.$row["nombre"].'
                                        &id_planta='.$row["id_planta"].'">
                                            Crear lote
                                    </a>
                                </td>';
                        echo '  <td>
                                    <a href="view_planta.php?id_planta='.$row['id_planta'].'">
                                        Información Planta
                                    </a>
                                </td>';
                        
            
                    echo '</table>';
                    echo '<br>';  
                }
            ?>
        </div>
    </center>
</section>
</body>
<script src="../assets/js/barra_lateral.js"></script>
</html>

