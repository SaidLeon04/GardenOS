<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, init-scale=1.0">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">   
    <link rel="stylesheet" href="CRUD/css/lote.css">
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
                        <a href="../plantas/plantas.php" title="Ver catálogo de plantas">
                            <img src="../assets/svg/planta.svg" alt="icono_planta" class="icon">
                            <span class="text nav-text">Plantas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="lotes.php">
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
    <div class="text">
        <header>
            Lotes de: <strong> <?php echo $usuario; ?></strong>
        </header> 
    </div>
        <?php
            $stmt = $conexion->prepare("SELECT plantas.id_planta, plantas.nombre, plantas.tipo, plantas.imagen, lote.id_lote, lote.nombre_lote, lote.fecha_inicial, lote.cantidad_actual, lote.estado FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta WHERE id_usuario = ? AND estado != 'finalizado' GROUP BY nombre_lote");
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $result = $stmt->get_result();
        ?>
    <center>
        <div>
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<table>';
                        echo '<tr><td colspan="5"><img src="data:image;base64,' . $row['imagen'] . '" alt="imagen.jpg"></td></tr>';
                        echo '<tr><td colspan="5"><h5>'.$row['nombre'].'</h5>';
                        echo '<h5>Fecha de registro: ' . $row["fecha_inicial"] . '</h5>';  
                        echo '<h1>'. $row["nombre_lote"].'</h1></td></tr>';
                        echo '<tr class = "descripcion"><td colspan="5">Estado actual: ' . $row["estado"] . '</tr></td>';
                        echo '<tr class = "descripcion"><td colspan="5">Cantidad actual: ' . $row["cantidad_actual"] . '</tr></td>';
                        echo '<tr colspan="5" class = "links"><td><a href="borrar_lote.php?id_lote='.$row['id_lote'].'">Información Lote</a></td>';                   
                        echo '<td><a href="acciones_lote.php?id_lote='.$row['id_lote'].'&nombre_lote='.$row['nombre_lote'].'">Actividad</a></td>';
                    echo '</table>'; 
                }
            ?>
           <br>
        </div>
    </center>
</section>
</body>
<script src="../assets/js/barra_lateral.js"></script>
</html>