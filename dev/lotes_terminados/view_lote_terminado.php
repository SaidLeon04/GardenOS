<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">  
    <link rel="stylesheet" href="css/stats.css">
    <?php 
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_lote = $_GET['key'];
        

        # obtener los datos necesarios
        $stmt = $conexion->prepare("SELECT imagen FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $pfp = $datos_usuario['imagen'];
            $stmt = $conexion->prepare("SELECT * FROM lote WHERE id_lote = ? AND id_usuario = ?");
            $stmt->bind_param("ii", $id_lote, $id_usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $info = $result->fetch_assoc();
                $id_sensor = $info['id_sensor'];
                $nombre_lote = $info['nombre_lote'];
                $fecha_inicial_str = $info['fecha_inicial'];
                $cantidad_actual = $info['cantidad_actual'];
                $estado = $info['estado'];
                $temperatura_optima = $info['temperatura_optima'];
                $humedad_optima = $info['humedad_optima'];
                $riego = $info['riego'];
                $intervalo = $info['intervalo'];  
            } else {
                echo "El lote no existe";
            }
        } else {
            echo "El usuario no existe";
        }


        # Obtener los dias transcurridos
        $fecha_inicial = new DateTime($fecha_inicial_str);
        $fecha_actual = new DateTime();
        $diferencia = $fecha_inicial->diff($fecha_actual);
        $dias = $diferencia->days;
    
    ?>
    <title>Dashboard <?php echo $nombre_lote; ?></title>
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
        <center>
            <div class="main-container">
                <center>
                <div class="titulo">
                    Lote: <strong> <?php echo $nombre_lote; ?> </strong>
                </div>
                </center>


                <div class="contenedor1">
                    <div class="carta-stats">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                                <h3>Días Totales</h3>
                                <img src="../assets/svg/dias.svg" alt="dias">    
                        </div>
                        <div>
                            <?php echo $dias; ?>
                        </div>  
                    </div>

                    <div class="carta-stats">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                            <h3>Cantidad Cosechada</h3>
                            <img src="../assets/svg/cantidad.svg" alt="cantidad">    
                        </div>
                        <div>
                            <?php echo $cantidad_actual ?>
                        </div>
                    </div>
            

                    <div class="carta-stats">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                            <h3>Previsión</h3>
                            <img src="../assets/svg/prevision.svg" alt="prevision">
                        </div>
                        <div>
                            <h3>76% efectividad</h3>
                            <?php #TODO consulta para obtener previsión ?>
                        </div>
                    </div>
                </div>

                <div class="contenedor2">
                    <div class="valores-optimos">
                        <h3>Valores Optimos</h3>
                        <h2>Promedios de todo. Divididos por procesos.</h2>
                        <h2>Germinacion: 6372 humedad | 3872 temp</h2>
                        <h2>Crecimiento: 6372 humedad | 3872 temp</h2>
                           
                        
                    </div>

                   

                    <div class="controls">
                        <button class="btn"><a href="../avance/avance.php?key=<?php echo $id_lote ?>">Estadisticas Finales</a></button>
                        <button class="btn"><a href="../historial/historial.php?key=<?php echo $id_lote ?>">Historial</a></button>
                        <!-- TODO enviar nombre del lote y gg -->
                    </div>
                </div>

                <div class="contenedor3">   
                    <h1>Has contribuido al proyecto GardenOS con datos alamecenados en tiempo real</h1>
                    <h1>Prick IA crecera con los resultados de tu lote terminado para mejorar constantemente</h1>
                    <h2>!Tu siguiente lote te espera!</h2>
                    <img src="" alt="">
                </div>      
            </div>     
        </center>
    </section>
</body>
<script src="../assets/js/barra_lateral.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/regresion.js"></script>
<script src="js/showHide.js"></script>
</html>