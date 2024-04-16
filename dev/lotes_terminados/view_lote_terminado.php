<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/lotes_terminados/css/stats.css">
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
                $cantidad_inicial = $info['cantidad_inicial'];
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

        $stmt = $conexion->prepare("SELECT AVG(COALESCE(temperatura, 0)) AS promedio_temperaturas FROM temperatura WHERE id_lote = ?");
        $stmt->bind_param("i", $id_lote);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            $temperatura_promedio = $info['promedio_temperaturas'];
            $temperatura_promedio = round($temperatura_promedio, 2);
        } else {
            $temperatura_promedio =  "No se encontraron temperaturas";
        }

        $stmt = $conexion->prepare("SELECT AVG(COALESCE(humedad, 0)) AS promedio_humedades FROM humedad WHERE id_lote = ?");
        $stmt->bind_param("i", $id_lote);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $info = $result->fetch_assoc();
            $humedad_promedio = $info['promedio_humedades'];
            $humedad_promedio = round($humedad_promedio, 2);
        } else {
            $humedad_promedio =  "No se encontraron humedades";
        }


        $efectividad = round(($cantidad_actual / $cantidad_inicial) * 100, 2);
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
                        <a href="http://localhost/proyectos/garden_os/perfil?id_usuario=<?php echo $id_usuario; ?>" class="pfp-link"><?php echo $usuario; ?></a>
                    </span>
                </div>
            </div>
                <img src="/proyectos/garden_os/dev/assets/svg/arrow.svg" alt="icono_arrow" class="toggle">
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="/proyectos/garden_os/home" title="Volver al inicio">
                            <img src="/proyectos/garden_os/dev/assets/svg/home.svg" alt="icono_home" class="icon">
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="/proyectos/garden_os/plantas" title="Ver catálogo de plantas">
                            <img src="/proyectos/garden_os/dev/assets/svg/planta.svg" alt="icono_planta" class="icon">
                            <span class="text nav-text">Plantas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="/proyectos/garden_os/lotes">
                            <img src="/proyectos/garden_os/dev/assets/svg/lotes.svg" alt="icono_lotes" class="icon">
                            <span class="text nav-text">Lotes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="/proyectos/garden_os/lotes_terminados">
                            <img src="/proyectos/garden_os/dev/assets/svg/lotes_terminados.svg" alt="icono_lotes" class="icon">
                            <span class="text nav-text">Lotes Terminados</span>
                        </a>
                    </li>  

                    <li class="nav-link">
                        <a href="/proyectos/garden_os/sensores">
                            <img src="/proyectos/garden_os/dev/assets/svg/humedad.svg" alt="icono_humedad" class="icon">
                            <span class="text nav-text">
                                Sensores
                            </span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="/proyectos/garden_os/zen">
                            <img src="/proyectos/garden_os/dev/assets/svg/zen.svg" alt="icono_zen" class="icon">
                            <span class="text nav-text">
                                Zen
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <a href="/proyectos/garden_os/help">
                        <img src="/proyectos/garden_os/dev/assets/svg/help.svg" alt="icono_help" class="icon">
                        <span class="text nav-text">Ayuda</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="/proyectos/garden_os/logout">
                        <img src="/proyectos/garden_os/dev/assets/svg/logout.svg" alt="icono_logout" class="icon">
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
                            <img src="/proyectos/garden_os/dev/assets/svg/dias.svg" alt="dias">  
                        </div>
                        <div>
                            <?php echo $dias; ?>
                        </div>  
                    </div>

                    <div class="carta-stats">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                            <h3>Cantidad Inicial</h3>
                            <img src="/proyectos/garden_os/dev/assets/svg/cantidad.svg" alt="cantidad">     
                        </div>
                        <div>
                            <?php echo $cantidad_inicial ?>
                            semillas
                        </div>
                    </div>

                    <div class="carta-stats">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                            <h3>Cantidad Cosechada</h3>
                            <img src="/proyectos/garden_os/dev/assets/svg/cantidad.svg" alt="cantidad">     
                        </div>
                        <div>
                            <?php echo $cantidad_actual ?>
                            plantas
                        </div>
                    </div>
            

                    <div class="carta-stats">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                            <h3>Efectividad</h3>
                            <img src="/proyectos/garden_os/dev/assets/svg/prevision.svg" alt="prevision">
                        </div>
                        <div>
                            <h3><?php echo $efectividad ?>%</h3>
                            
                        </div>
                    </div>
                </div>

                <div class="contenedor2">
                    <div class="valores-optimos">
                        <h2>Valores Optimos</h2>
                        <p>Tus valores durante cada proceso del lote representan que camino seguir en tu siguiente lote de la misma planta.</p>
                        <?php 
                            $stmt = $conexion->prepare("SELECT temperatura_optima, humedad_optima FROM lote WHERE id_lote = ?");
                            $stmt->bind_param("i", $id_lote);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                $info = $result->fetch_assoc();
                                $temp_optima = $info['temperatura_optima'];
                                $humedad_optima = $info['humedad_optima'];
                            } else {
                                echo "No se encontraron valores";
                            }
                        ?>
                        <p class="texto">Temperatura Óptima: <?php echo $temperatura_optima ?> °C</p>
                        <p class="texto">Humedad Óptima: <?php echo $humedad_optima ?> %</p>
                    </div>
                    <div class="valores-usados">
                    <h2>Valores usados</h2>
                    <p>Porque no todo sale como uno espera... los valores reales usados en tu lote:</p>
                        <p class="texto">Temperatura: <?php echo $temperatura_promedio ?> °C</p>
                        <p class="texto">Humedad: <?php echo $humedad_promedio ?> %</p>

                    </div>

                   

                    <div class="controls">
                        <button class="btn"><a href="/proyectos/garden_os/final?key=<?php echo $id_lote ?>">Estadisticas Finales</a></button>
                        <button class="btn"><a href="/proyectos/garden_os/historial?key=<?php echo $id_lote ?>">Historial</a></button>
                    </div>
                </div>

                <div class="contenedor3">   
                    
                </div>      
            </div>     
        </center>
    </section>
</body>
<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/regresion.js"></script>
<script src="js/showHide.js"></script>
</html>