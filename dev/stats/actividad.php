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
        
        # minutos
        $intervalo_convertido = $intervalo * 60 ;
        
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
        <div class="text">
            <header>
                Lote: <strong> <?php echo $nombre_lote; ?> </strong>
            </header> 
        </div>
        <center>
            <div class="main-container">
                <div class="contenedor1">
                    <div class="general-seccion1">
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
                            <?php echo $cantidad_actual ?>
                        </div>
                    </div>

                    <div class="general-seccion2">
                        <div class="carta-stats">
                            <div style="display:flex; flex-direction:row; justify-content: space-around;">
                                <h3>Proceso Actual</h3>
                                <img src="../assets/svg/proceso.svg" alt="proceso">
                            </div>
                            <?php echo $estado ?>
                        </div>
                        <div class="carta-stats">
                            <div style="display:flex; flex-direction:row; justify-content: space-around;">
                                <h3>Previsión</h3>
                                <img src="../assets/svg/prevision.svg" alt="prevision">
                            </div>
                            <h3>Previsión</h3>
                            <?php #TODO consulta para obtener previsión ?>
                        </div>
                    </div>

                    <div class="general-seccion3">
                        <div style="display:flex; flex-direction:row; justify-content: space-around;">
                            <h3>Valores Optimos</h3>
                            <button class="edit-button"><a href="config_valores.php?id_lote=<?php echo $id_lote; ?>">Establecer</a></button>
                        </div>
                       
                        <div>
                            <?php
                                if ($temperatura_optima == 0 || $humedad_optima == 0 || $riego == 0) {
                                    echo "No hay valores óptimos establecidos correctamente.";
                                }else {
                                    echo "<div class='static-num-unique'><h4>Humedad: </h4>" . $humedad_optima . "%</div>";
                                    echo "<div class='static-num-unique'><h4>Temperatura: </h4>" . $temperatura_optima . "°C</div>";
                                    echo "<div class='static-num-unique'><h4>Riego con humedad al: </h4>" . $riego . "%</div>";    
                                }
                            ?>
                        </div> 

                    </div>

                    <div class="general-seccion4">
                        <h3>Valores Actuales</h3>
                        <div>
                            <?php
                                if(is_null($id_sensor)){
                                    echo "No hay un sensor conectado.";
                                }else{
                                    echo "<div class='static-num-unique'>Tu sensor estara actualizando los valores cada: ". $intervalo . " minutos. </div>";
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

                                        echo '<h4>Humedad: </h4>';
                                        echo '<p class="texto-valores">' . $humedad .'%</p>';
                                        echo '<h4>Temperatura: </h4>';
                                        echo '<p class="texto-valores">'. $temperatura . '</p>';
                                        

                                        $stmt = $conexion->prepare("SELECT hora FROM humedad WHERE id_lote = ? ORDER BY id_humedad DESC LIMIT 1");
                                        $stmt->bind_param("i", $id_lote);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        if ($result->num_rows > 0) {
                                            $hora_bd = $result->fetch_assoc()['hora'];
                                
                                            $hora_parseo = strtotime($hora_bd);
                                            $ultima_hora = date("H:i", $hora_parseo); # hora de la ultima insersion a la bd   

                                            $fecha_actual = date("Y-m-d");
                                            
                                            $hora_actual = date("H:i");   

                                            $ultima_hora = $fecha_insert . " " . $hora_actual;

                                            echo "hora insert".  $hora_insert;

                                            $nueva_hora = date("Y--m-d H:i", strtotime($ultima_hora . "+" . $intervalo . "minutes"));
                                            echo $nueva_hora;

                                            echo "Ultima actualización hoy a las: " . $ultima_hora . " hrs<br>";

                                            if ($hora_insert >= $nueva_hora) {
                                                $stmt = $conexion->prepare("INSERT INTO humedad (id_lote, fecha, hora, humedad) VALUES (?, ?, ?, ?)");
                                                $stmt->bind_param("isss", $id_lote, $fecha_insert, $hora_actual, $humedad);
                                                $stmt->execute();

                                                $stmt = $conexion->prepare("INSERT INTO temperatura (id_lote, fecha, hora, temperatura) VALUES (?, ?, ?, ?)");
                                                $stmt->bind_param("isss", $id_lote, $fecha_insert, $hora_actual, $temperatura);
                                                $stmt->execute();
                                            } else {
                                                echo "no se ha actualizado la base de datos.";
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
                    </div>
                </div>                
                <div class="contenedor2">
                    <div style="display:flex; flex-direction:row; justify-content: space-between; width: 65%;">
                        <h2>Registros</h2>
                        <button type="button" onclick="return cambiarHumedad()" class="next-button">Ver siguiente</button>
                    </div>
                    <div style="display:flex; flex-direction:row; justify-content: center; width:30%">
                        Acciones
                    </div>
              </div>

                <div class="contenedor3">   

                    <div class="tabla-seccion1">
                                <table id="tablaHumedad" style="width=100%; height:285;">
                            <th colspan=3>
                                <div class="titulo-tabla">
                                    <h3>Humedad</h3>
                                    
                                </div>
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
                    </div>

                    <div class="tabla-seccion2">
                        <canvas id="graficaHumedad"></canvas>
                    </div>

                    
                    <div class="controls">
                        <button class="btn"><a href="../avance/avance.php?key=<?php echo $id_lote ?>">Avanzar al siguiente paso</a></button>
                        <button class="btn"><a href="../historial/historial.php?key=<?php echo $id_lote ?>">Historial</a></button>
                        <button class="btn"><a href="http://127.0.0.1:8081/">Prick IA</a></button>
                        <!-- TODO enviar nombre del lote y gg -->
                    </div>



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