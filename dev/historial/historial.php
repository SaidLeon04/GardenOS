<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/historial/css/historial.css">
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
            header("Location: ../login/login.php");
        }

       
            $stmt = $conexion->prepare("SELECT * FROM lote WHERE id_usuario = ? AND id_lote = ?");
            $stmt->bind_param('ii',$id_usuario, $id_lote);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $lote = $result->fetch_assoc();
                $nombre_lote = $lote['nombre_lote'];
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
                        <a href="/proyectos/garden_os/perfil?id_usuario=<?php echo $id_usuario; ?>" class="pfp-link"><?php echo $usuario; ?></a>
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
        <div class="text">
            <header>
                Historial de: <?php echo $nombre_lote;?>  
                <button class="help-button">Ayuda</button>
            </header>
        </div>
        <center>  
            <section class="main-container">
                <div class="timeline">
                <?php 
                    $stmt = $conexion->prepare("SELECT * FROM historial WHERE id_lote = ?");
                    $stmt->bind_param('i', $id_lote);
                    $stmt->execute();
                    $result = $stmt->get_result(); 

                    $fila_anterior = array();   
                    $fila_siguiente = array(); 

                        while ($info = $result->fetch_assoc()) {
                            $fecha_traducida = strftime('%A, %d de %B de %Y', strtotime($info['fecha']));
                            $fecha_traducida = str_replace(
                                    ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                                    ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                                    $fecha_traducida
                            );
                            
                            $fecha_traducida = str_replace(
                                    ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                    ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                    $fecha_traducida
                            );
                            if ($info['estado'] == "germinacion") {  

                                $stmt = $conexion->prepare("SELECT fecha FROM historial WHERE id_lote = ? LIMIT 2");
                                $stmt->bind_param('i', $id_lote);
                                $stmt->execute();
                                $fechas = $stmt->get_result();
                                $num_filas = $fechas->num_rows;

                                if ($num_filas == 1) {
                                    $diferencia_dias = "En proceso... ";
                                    $promedio_humedad = "En proceso... ";
                                    $temperatura_formateada = "En proceso... ";
                                    $horas_riego = "En proceso... ";
                                } elseif ($num_filas === 2) {
                                    if ($info1 = $fechas->fetch_assoc()) {
                                        $fecha1 = $info1['fecha'];
                                    }
                                    if ($info2 = $fechas->fetch_assoc()) {
                                        $fecha2 = $info2['fecha'];
                                    }
                                    $fecha1_obj = new DateTime($fecha1);
                                    $fecha2_obj = new DateTime($fecha2);

                                    $diferencia = $fecha1_obj->diff($fecha2_obj);

                                    $diferencia_dias = $diferencia->days;

                                    $stmt = $conexion->prepare("SELECT AVG(humedad) AS promedio_humedad FROM humedad WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                    $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                    $stmt->execute();
                                    $resultado = $stmt->get_result();
                                    $humedad = $resultado->fetch_assoc();
                                    $promedio_humedad = $humedad['promedio_humedad'];  

                                    $stmt = $conexion->prepare("SELECT AVG(temperatura) AS promedio_temperatura FROM temperatura WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                    $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                    $stmt->execute();
                                    $resultado = $stmt->get_result();
                                    $temperatura = $resultado->fetch_assoc();
                                    $promedio_temperatura = $temperatura['promedio_temperatura'];  
                                    $temperatura_formateada = number_format($promedio_temperatura, 2);

                                    $stmt = $conexion->prepare("SELECT SUM(duracion) AS horas_riego FROM riego WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                    $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                    $stmt->execute();
                                    $resultado = $stmt->get_result();
                                    $riego = $resultado->fetch_assoc();
                                    $horas_riego = $riego['horas_riego'];  
                                }
                               
                ?>
                                <div><!--Espacio--></div>
                                <div class="line">
                                <div class="dot"> <!--punto--> </div>
                                </div>

                                <div class="timeline-tile">
                                    <h2>Estado: Germinación</h2>
                                    <p>Fecha de inicio: <?php echo $fecha_traducida ?></p>
                                    <p>Dias: <?php echo $diferencia_dias ?></p>
                                    <p>Cantidad: <?php echo $info['cantidad'] ?> semillas </p>
                                    <p>Promedio de humedad: <?php echo $promedio_humedad ?>%</p>
                                    <p>Promedio de temperatura: <?php echo $temperatura_formateada ?>°C </p>
                                    <p>Horas de riego: <?php echo $horas_riego ?> hrs.</p>
                                </div>
                <?php
                            } else if ($info['estado'] == "siembra") {
                                if ($fila_anterior !== null) {
                                    $cantidad_siguiente = $fila_anterior['cantidad'];
                                    $perdida = $cantidad_siguiente -  $info['cantidad'];
                                   
                                    $stmt = $conexion->prepare("SELECT fecha FROM historial WHERE id_lote = ? AND estado = 'crecimiento'");
                                    $stmt->bind_param('i', $id_lote);
                                    $stmt->execute();
                                    $fechas = $stmt->get_result();
                                    $infofecha = $fechas->fetch_assoc();
                                    $num_filas = $fechas->num_rows;
                                    

                                    if ($num_filas !== 1) {
                                        $diferencia_dias = "En proceso... ";
                                        $promedio_humedad = "En proceso... ";
                                        $temperatura_formateada = "En proceso... ";
                                        $horas_riego = "En proceso... ";
                                    } elseif ($num_filas === 1){
                                        $fecha1 = $info['fecha'];
                                        $fecha2 = $infofecha['fecha'];
                                        $fecha1_obj = new DateTime($fecha1);
                                        $fecha2_obj = new DateTime($fecha2);

                                        $diferencia = $fecha1_obj->diff($fecha2_obj);

                                        $diferencia_dias = $diferencia->days;

                                        $stmt = $conexion->prepare("SELECT AVG(humedad) AS promedio_humedad FROM humedad WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $humedad = $resultado->fetch_assoc();
                                        $promedio_humedad = $humedad['promedio_humedad']; 
                                        $humedad_formateada = number_format($promedio_humedad, 2);

                                        $stmt = $conexion->prepare("SELECT AVG(temperatura) AS promedio_temperatura FROM temperatura WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $temperatura = $resultado->fetch_assoc();
                                        $promedio_temperatura = $temperatura['promedio_temperatura'];  
                                        $temperatura_formateada = number_format($promedio_temperatura, 2);

                                        $stmt = $conexion->prepare("SELECT SUM(duracion) AS horas_riego FROM riego WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $riego = $resultado->fetch_assoc();
                                        $horas_riego = $riego['horas_riego'];
                                    }   
                                }   
                ?>
                                <div class="timeline-tile">
                                        <h2>Estado: Siembra</h2>
                                        <p>Fecha de inicio: <?php echo $fecha_traducida ?></p>
                                        <p>Dias: <?php echo $diferencia_dias ?></p>
                                        <p>Cantidad: <?php echo $info['cantidad'] ?> semillas </p>
                                        <p>Perdidas: <?php echo $perdida ?> semillas </p>
                                        <p>Promedio de humedad: <?php echo $humedad_formateada ?>%</p>
                                        <p>Promedio de temperatura: <?php echo $temperatura_formateada ?>°C </p>
                                        <p>Horas de riego: <?php echo $horas_riego ?> hrs.</p>
                                </div>
                                <div class="line">
                                    <div class="dot"></div>
                                    </div>
                                <div>
                                    <!--Espacio-->
                                </div>
                <?php 
                            } elseif ($info['estado'] == "crecimiento") {
                                if ($fila_anterior !== null) {
                                    $cantidad_siguiente = $fila_anterior['cantidad']; 
                                    $perdida = $cantidad_siguiente -  $info['cantidad']; 

                                    $stmt = $conexion->prepare("SELECT fecha FROM historial WHERE id_lote = ? AND estado = 'cosecha'");
                                    $stmt->bind_param('i', $id_lote);
                                    $stmt->execute();
                                    $fechas = $stmt->get_result();
                                    $infofecha = $fechas->fetch_assoc();
                                    $num_filas = $fechas->num_rows;
                                    

                                    if ($num_filas === 0) {
                                        $diferencia_dias = "En proceso... ";
                                        $promedio_humedad = "En proceso... ";
                                        $temperatura_formateada = "En proceso... ";
                                        $horas_riego = "En proceso... ";
                                    } elseif ($num_filas === 1){
                                        $fecha1 = $info['fecha'];
                                        $fecha2 = $infofecha['fecha'];
                                        $fecha1_obj = new DateTime($fecha1);
                                        $fecha2_obj = new DateTime($fecha2);

                                        $diferencia = $fecha1_obj->diff($fecha2_obj);

                                        $diferencia_dias = $diferencia->days;

                                        $stmt = $conexion->prepare("SELECT AVG(humedad) AS promedio_humedad FROM humedad WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $humedad = $resultado->fetch_assoc();
                                        $promedio_humedad = $humedad['promedio_humedad'];  

                                        $stmt = $conexion->prepare("SELECT AVG(temperatura) AS promedio_temperatura FROM temperatura WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $temperatura = $resultado->fetch_assoc();
                                        $promedio_temperatura = $temperatura['promedio_temperatura'];  
                                        $temperatura_formateada = number_format($promedio_temperatura, 2);

                                        $stmt = $conexion->prepare("SELECT SUM(duracion) AS horas_riego FROM riego WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $riego = $resultado->fetch_assoc();
                                        $horas_riego = $riego['horas_riego'];
                                    }   
                                }   
                ?>
                                <div><!--Espacio--></div>
                                <div class="line">
                                <div class="dot"> <!--punto--> </div>
                                </div>

                                <div class="timeline-tile">
                                    <h2>Estado: Crecimiento</h2>
                                    <p>Fecha de inicio: <?php echo $fecha_traducida ?></p>
                                    <p>Dias: </p>
                                    <p>Cantidad: <?php echo $info['cantidad'] ?> semillas </p>
                                    <p>Perdidas: <?php echo $perdida ?> semillas </p>
                                    <p>Promedio de humedad: <?php echo $promedio_humedad ?></p>
                                    <p>Promedio de temperatura: <?php echo $temperatura_formateada ?></p>
                                    <p>Horas de riego: <?php echo $horas_riego ?></p>
                                </div>
                <?php
                            } elseif ($info['estado'] == "cosecha") {
                                if ($fila_anterior !== null) {
                                    $cantidad_siguiente = $fila_anterior['cantidad'];
                                    $perdida = $cantidad_siguiente -  $info['cantidad']; 
                                    
                                    $stmt = $conexion->prepare("SELECT fecha FROM historial WHERE id_lote = ? AND estado = 'cosecha'");
                                    $stmt->bind_param('i', $id_lote);
                                    $stmt->execute();
                                    $fechas = $stmt->get_result();
                                    $infofecha = $fechas->fetch_assoc();
                                    $num_filas = $fechas->num_rows;
                                    

                                    if ($num_filas === 1) {
                                        $diferencia_dias = "En proceso... ";
                                        $promedio_humedad = "En proceso... ";
                                        $temperatura_formateada = "En proceso... ";
                                        $horas_riego = "En proceso... ";
                                    } elseif ($num_filas !== 1){
                                        $fecha1 = $info['fecha'];
                                        $fecha2 = $infofecha['fecha'];
                                        $fecha1_obj = new DateTime($fecha1);
                                        $fecha2_obj = new DateTime($fecha2);

                                        $diferencia = $fecha1_obj->diff($fecha2_obj);

                                        $diferencia_dias = $diferencia->days;

                                        $stmt = $conexion->prepare("SELECT AVG(humedad) AS promedio_humedad FROM humedad WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $humedad = $resultado->fetch_assoc();
                                        $promedio_humedad = $humedad['promedio_humedad'];  

                                        $stmt = $conexion->prepare("SELECT AVG(temperatura) AS promedio_temperatura FROM temperatura WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $temperatura = $resultado->fetch_assoc();
                                        $promedio_temperatura = $temperatura['promedio_temperatura'];  
                                        $temperatura_formateada = number_format($promedio_temperatura, 2);

                                        $stmt = $conexion->prepare("SELECT SUM(duracion) AS horas_riego FROM riego WHERE id_lote = ? AND fecha BETWEEN ? AND ?");    
                                        $stmt->bind_param('iss', $id_lote, $fecha1, $fecha2);
                                        $stmt->execute();
                                        $resultado = $stmt->get_result();
                                        $riego = $resultado->fetch_assoc();
                                        $horas_riego = $riego['horas_riego'];
                                    }   
                                }   
                                
                ?>
                                <div class="timeline-tile">
                                        <h2>Estado: Cosecha</h2>
                                        <p>Fecha de inicio: <?php echo $fecha_traducida ?></p>
                                        <p>Dias: <?php echo $diferencia_dias ?></p>
                                        <p>Cantidad: <?php echo $info['cantidad'] ?> semillas </p>
                                        <p>Perdidas: <?php echo $perdida ?> semillas </p>
                                        <p>Promedio de humedad: <?php echo $promedio_humedad ?>%</p>
                                        <p>Promedio de temperatura: <?php echo $temperatura_formateada ?>°C </p>
                                        <p>Horas de riego: <?php echo $horas_riego ?> hrs.</p>
                                    </div>
                                    <div class="line">
                                        <div class="dot"></div>
                                    </div>
                                    <div>
                                        <!--Espacio-->
                                    </div>
                <?php
                            }
                           
                            $fila_anterior = $info;
                            
                           
                        }
                
                
                    ?>
                </div>
            </section>
        </center>
      
    </section>
</body>
<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>
</html>