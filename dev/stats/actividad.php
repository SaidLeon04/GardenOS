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
        $id_lote = $_GET['id_lote'];
        

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
                                <h3>Días Activo</h3>
                                <img src="../assets/svg/dias.svg" alt="dias">    
                        </div>
                        <div>
                            <?php echo $dias; ?>
                        </div>  
                    </div>

                    <div class="carta-stats">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                            <h3>Cantidad Actual</h3>
                            <img src="../assets/svg/cantidad.svg" alt="cantidad">    
                        </div>
                        <div>
                            <?php echo $cantidad_actual ?>
                        </div>
                    </div>
            
                    <div class="carta-stats">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                                <h3>Proceso Actual</h3>
                                <img src="../assets/svg/proceso.svg" alt="proceso">
                        </div>
                        <div>
                            <?php echo $estado ?>
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
                        
                            <?php
                                if ($temperatura_optima == 0 || $humedad_optima == 0 || $riego == 0) {
                                        echo "No hay valores óptimos establecidos correctamente.";
                                }else {
                                        echo "<div class='valor-optimo'><h4>Humedad: </h4>" . $humedad_optima . "%</div>";
                                        echo "<div class='valor-optimo'><h4>Temperatura: </h4>" . $temperatura_optima . "°C</div>";
                                        echo "<div class='valor-optimo'><h4>Riego con humedad al: </h4>" . $riego . "%</div>";    
                                }
                            ?>
                        <center>
                            <button class="edit-button"><a href="config_valores.php?id_lote=<?php echo $id_lote; ?>">Establecer</a></button>
                        </center>
                    </div>

                    <div class="valores-actuales">
                        <h3>Valores Actuales</h3>
                      
                            <?php
                                if(is_null($id_sensor)){
                                    echo "No hay un sensor conectado.";
                                }else{
                                    echo "<div class='valor-optimo'><h4>Tu sensor estara actualizando los valores cada: </h4>". $intervalo . " minutos. </div>";
                                    $stmt = $conexion->prepare("SELECT url_conexion FROM sensores WHERE id_lote = ? AND id_usuario = ?");
                                    $stmt->bind_param("ii", $id_lote, $id_usuario);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        $url = $result->fetch_assoc()['url_conexion'];
                                        $uri = 'https://gardenos-5a87b-default-rtdb.firebaseio.com/gardenos/3.json';
                                        $respuesta = file_get_contents($uri);
                                        $datos = json_decode($respuesta);

                                        $humedad = $datos->humedad;
                                        $temperatura = $datos->temperatura;

                                        echo "<div class='valor-optimo'><h4>Humedad: </h4><p>" . $humedad . "%</p></div>";
                                        echo "<div class='valor-optimo'><h4>Temperatura: </h4><p>" . $temperatura . "</p></div>";
                                        

                                        $stmt = $conexion->prepare("SELECT CONCAT(fecha, ' ', hora) AS fecha_hora FROM humedad WHERE id_lote = ? ORDER BY id_humedad DESC LIMIT 1;");
                                        $stmt->bind_param("i", $id_lote);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        if ($result->num_rows > 0) {
                                            $fecha = $result->fetch_assoc();
                                            $fecha_hora_bd = $fecha['fecha_hora'];
                                            $fecha_hora_actual = date("Y-m-d H:i:s");
                                       

                                            $timestamp_bd = strtotime($fecha_hora_bd);
                                            $timestamp_actual = strtotime($fecha_hora_actual);

                                            // Sumar el intervalo de minutos al timestamp de la fecha actual
                                            $timestamp_intervalo = $timestamp_bd + ($intervalo * 60);
                                       
                                            // Convertir el timestamp del intervalo de tiempo a formato de fecha y hora
                                            $fecha_hora_intervalo = date("Y-m-d H:i:s", $timestamp_intervalo);
                                            
                                            
                                            $fecha_con_nombres = date("l, j F Y -    H:i:s", $timestamp_bd);
                                            echo "<div class='valor-optimo'><h4>Ultima actualización: </h4><p>" . $fecha_con_nombres . " hrs.</p></div>";
                                            
                                           

                                            if ($timestamp_actual >= $timestamp_intervalo) {
                                                
                                                $fecha_actual = substr($fecha_hora_actual, 0, 10); // Obtiene "Y-m-d"
                                                $hora_actual = substr($fecha_hora_actual, 11); 

                                                $stmt = $conexion->prepare("INSERT INTO humedad (id_lote, fecha, hora, humedad) VALUES (?, ?, ?, ?)");
                                                $stmt->bind_param("isss", $id_lote, $fecha_actual, $hora_actual, $humedad);
                                                $stmt->execute();

                                                $stmt = $conexion->prepare("INSERT INTO temperatura (id_lote, fecha, hora, temperatura) VALUES (?, ?, ?, ?)");
                                                $stmt->bind_param("isss", $id_lote, $fecha_actual, $hora_actual, $temperatura);
                                                $stmt->execute();
                                            } else {
                                                $nothis = "no";
                                                #echo "no se ha actualizado la base de datos.";
                                            }
                                        } else {
                                            echo "No hay registros de humedad.";
                                            $fecha = date("Y-m-d");
                                            $hora_actual = date("H:i");
                                            
                                            $stmt = $conexion->prepare("INSERT INTO humedad (id_lote, fecha, hora, humedad) VALUES (?, ?, ?, ?)");
                                            $stmt->bind_param("isss", $id_lote, $fecha, $hora_actual, $humedad);
                                            $stmt->execute();

                                            $stmt = $conexion->prepare("INSERT INTO temperatura (id_lote, fecha, hora, temperatura) VALUES (?, ?, ?, ?)");
                                            $stmt->bind_param("isss", $id_lote, $fecha, $hora_actual, $temperatura);
                                            $stmt->execute();
                                        }
                                    } else {
                                        echo "Ha ocurrido un problema en la conexión con el sensor.";
                                    }
                                }
                            ?>
                      
                    </div>

                    <div class="controls">
                        <button class="btn"><a href="../avance/avance.php?key=<?php echo $id_lote ?>">Avanzar al siguiente paso</a></button>
                        <button class="btn"><a href="../historial/historial.php?key=<?php echo $id_lote ?>">Historial</a></button>
                        <button class="btn"><a href="http://127.0.0.1:8081/">Prick IA</a></button>
                        <!-- TODO enviar nombre del lote y gg -->
                    </div>
                </div>

                

                <div class="contenedor3">   
                    <div class="control-tabla">
                        <button class="btn"  onclick="showHide()" >Cambiar</button>
                    </div>  
                    <h1 id="tituloHumedad">Humedad</h1>   
                    <h1 style= "display: none;" id="tituloTemperatura" >Temperatura</h1>
                    
                    <div class="seccion-tabla">
 
                        <div class="tablas">
                            <br><br>
                            <table id="tablaHumedad" style="display: block;" >
                                <th colspan=3>
                                    Humedad
                                </th>
                                <?php 
                                    $stmt = $conexion->prepare("SELECT * FROM humedad WHERE id_lote = ? ORDER BY fecha DESC, hora DESC LIMIT 5");
                                    $stmt->bind_param("i", $id_lote);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        echo "<tr><th>Fecha</th><th>Hora</th><th>Humedad</th></tr>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr><td>" . $row['fecha'] . "</td><td>" . $row['hora'] . "hrs.</td><td>" . $row['humedad'] . "%</td></tr>";
                                        }
                                    } else {
                                        echo "No hay registros de humedad.";
                                    }
                                ?>
                            </table>
            
                            <table id="tablaTemperatura" style="display: none;">
                                <th colspan=3>
                                    Temperatura
                                </th>
                                <?php 
                                    $stmt = $conexion->prepare("SELECT * FROM temperatura WHERE id_lote = ? ORDER BY fecha DESC, hora DESC LIMIT 5");
                                    $stmt->bind_param("i", $id_lote);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        echo "<tr><th>Fecha</th><th>Hora</th><th>Temperatura</th></tr>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr><td>" . $row['fecha'] . "</td><td>" . $row['hora'] . "hrs.</td><td>" . $row['temperatura'] . "°C</td></tr>";
                                        }
                                    } else {
                                        echo "No hay registros de temperatura.";
                                    }
                                ?>
                            </table>

                        </div>
                        <div class=graficas>
                            <br><br>
                            <canvas id="graficaHumedad"></canvas>

                            <canvas id="graficaTemperatura" style="display: none;"></canvas>
                        </div>
                    </div>  
                </div>      
            </div>     
        </center>
    </section>
</body>
<script src="../assets/js/barra_lateral.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/graficaHumedad.js"></script>
<script src="js/graficaTemperatura.js"></script>
<script src="js/showHide.js"></script>


</html>