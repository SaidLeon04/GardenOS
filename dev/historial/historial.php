<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">  
    <link rel="stylesheet" href="css/historial.css">
    <title>Historial</title>

    <?php
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_lote = $_GET['key'];

        $stmt = $conexion->prepare("SELECT imagen FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $pfp = $datos_usuario['imagen'];
        } else {
            echo "El usuario no existe";
        }

        $stmt = $conexion->prepare("SELECT * FROM lote WHERE id_usuario = ? AND id_lote = ?");
        $stmt->bind_param('ii',$id_usuario, $id_lote);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $lote = $result->fetch_assoc();
            $nombre_lote = $lote['nombre_lote'];
            $fecha_inicial = $lote['fecha_inicial'];
            $cantidad_actual = $lote['cantidad_actual'];      
        } else {
            echo "EL lote no existe";
        }
    ?>
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="data:image;base64,<?php echo $pfp; ?>" alt="pfp" id="pfp">
                </span>

                <div class="text logo-text">
                    <span class="name">
                        <a class="pfp-link" href="../perfil/view_perfil.php?id_usuario=<?php echo $id_usuario; ?>"><?php echo $usuario; ?></a>
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
                Historial de: <?php echo $nombre_lote ?>   
            </header>
        </div>
        <center>
        
            <section class="design-section">
            <div class="timeline">

                    <!--Well, The reason for this div is to fill space. 
            This space is technically used for keeping dates, 
            but I didn't find the need for dates. However, I'll provide 
            you the styling for dates, so that you can use it if you 
            wanted to.-->
                            <div class="timeline-empty">
                            </div>

            <!--This is the class where the timeline graphics are 
            housed in. Note that we have timeline-circle 
            here for that pointer in timeline.-->

                        <div class="timeline-middle">
                            <div class="timeline-circle"></div>
                        </div>
                        <div class="timeline-component timeline-content">
                            <h3>HTML</h3>
                            <p>Some Text</p>
                    </div>
                            <div class="timeline-component timeline-content">
                                    <h3>CSS</h3>
                                    <p>Some Text.</p>
                            </div>
                            <div class="timeline-middle">
                                <div class="timeline-circle"></div>
                            </div>
                            <div class="timeline-empty">
                            </div>

                            <div class="timeline-empty">
                            </div>

                        <div class="timeline-middle">
                            <div class="timeline-circle"></div>
                        </div>
                        <div class=" timeline-component timeline-content">
                            <h3>Javascript</h3>
                            <p>Some Text.</p>
                    </div>

                </div>
                </div> 
            </section>
        </center>
    </section>
</body>
<script src="../assets/js/barra_lateral.js"></script>
</html>