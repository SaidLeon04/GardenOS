<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/home/css/home.css">
    <title>GardenOS</title>
    <?php
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];

        $stmt = $conexion->prepare("SELECT imagen FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $datos_usuario = $result->fetch_assoc();
            $pfp = $datos_usuario['imagen'];
            $result -> free_result();   
        }else{
            session_destroy();
            header("Location: /proyectos/garden_os/sign_in");
        }

        $stmt = $conexion->prepare("SELECT id_lote FROM lote WHERE id_usuario = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $array_id_lotes = array();

        if ($resultado->num_rows > 0) {
            $titulo = 1;
            while ($row = $resultado->fetch_assoc()) {
                $array_id_lotes[] = $row['id_lote'];  
            }
            $id_aleatorio = $array_id_lotes[array_rand($array_id_lotes)];
            $stmt = $conexion->prepare("SELECT plantas.nombre, plantas.imagen, lote.nombre_lote, lote.fecha_inicial, lote.cantidad_actual FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta WHERE plantas.id_usuario = ? AND id_lote=?");
            $stmt->bind_param('ii',$id_usuario, $id_aleatorio);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $lote = $result->fetch_assoc();
                $nombre_planta = $lote['nombre'];
                $imagen = $lote['imagen'];
                $nombre_lote = $lote['nombre_lote'];
                $fecha_inicial_str = $lote['fecha_inicial'];
                $cantidad_actual = $lote['cantidad_actual'];   
                
                $fecha_inicial = new DateTime($fecha_inicial_str);
                $fecha_actual = new DateTime();
                $diferencia = $fecha_inicial->diff($fecha_actual);
                $dias = $diferencia->days;
            }
        } else {
            $titulo = 0;
        }
 
        $stmt = $conexion->prepare("SELECT id_sensor FROM sensores WHERE id_usuario = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $array_id_sensor = array();
        if ($resultado->num_rows > 0) {
            $titulo_sensor = 1;
            while ($row = $resultado->fetch_assoc()) {
                $array_id_sensor[] =  $row['id_sensor'];
            }
            $id_sensor_aleatorio = $array_id_sensor[array_rand($array_id_sensor)];

            $stmt = $conexion->prepare("SELECT * FROM sensores WHERE id_usuario = ? AND id_sensor = ?");
            $stmt->bind_param('ii',$id_usuario, $id_sensor_aleatorio);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $sensor = $result->fetch_assoc();
                $id_lote_sensor = $sensor['id_lote'];
                $nombre_sensor = $sensor['nombre'];
                $tipo = $sensor['tipo'];
                $url_conexion = $sensor['url_conexion'];

                $respuesta = file_get_contents($url_conexion);
                $datos = json_decode($respuesta);
                $humedad = $datos->humedad;
                $temperatura = $datos->temperatura; 

                $stmt = $conexion->prepare("SELECT nombre_lote FROM lote WHERE id_lote = ?");
                $stmt->bind_param('i', $id_lote_sensor);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $lote_sensor = $result->fetch_assoc();
                    $nombre_lote_sensor = $lote_sensor['nombre_lote'];
                }



            } 
        }else{
            $titulo_sensor = 0;
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
        <div class="text">
            <header>
                Bienvenido  <?php echo $usuario; ?> 
            </header>
        </div>

        <div class="main-container">
            <div class="medium-container">
                <div class="contenedor1">
                    <?php 
                        if ($titulo === 0) {
                    ?>
                    <h1>Crea tu primer lote</h1>
                    <button class="create-button">Crear</button>
                    
                    <?php
                        }else{
                    ?>
                    <div>
                        <h1>Revisa tus lotes constantemente</h1>
                    </div>
                    <div class="datos-lote">
                        <div class="datos-lote-texto">
                            <h2 class="text nombre-lote"><?php echo $nombre_lote; ?></h2>
                            <p class="parrafo">Semillas actuales: <?php echo $cantidad_actual ?></p>
                            <p class="parrafo">Dias activo: <?php echo $dias ?></p>
                        </div>
                        <div class="img-datos">
                            <img src="data:image;base64,<?php echo $imagen ?>" alt="imagen_planta" class="img">
                        </div>
                    </div>
                    <button class="help-button boton-actividad"><a href="/proyectos/garden_os/dashboard?id_lote=<?php echo $id_aleatorio; ?>">Actividad</a></button>
                    <?php
                        }
                    ?>
                </div>

                <div class="contenedor2">
                    <?php 
                        if ($titulo_sensor === 0) {
                    ?>
                    <h1>Comprueba lo que puedes hacer con un sensor.</h1>
                    <button class="create-button">Agregar sensor</button>
                    <img src="/assets/img/dht22.png" alt="dht22.png">
                    
                    <?php
                        }else{
                    ?>
                    <div>
                        <h1>Vistazo al sensor: </h1>
                    </div>
                    <div class="datos-sensor">
                        <div class="sensor1">
                            <center>
                            <p class="text"><?php echo $nombre_sensor; ?></p>
                            <p class="parrafo"><?php echo $tipo; ?></p>
                            En el lote:<p class="parrafo"> <?php echo $nombre_lote_sensor ?></p>
                            </center>
                        </div>
                        <div class="sensor2">
                            <center>
                            <p class="parrafo">Temperatura actual: <?php echo $temperatura ?></p>
                            <p class="parrafo">Humedad actual: <?php echo $humedad ?></p>
                            </center>
                        </div>
                        
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="contenedor3">
                <h1>¿Donde iniciar?</h1>

                <button class="create-button-re"><a href="/proyectos/garden_os/plantas/c">Agrega plantas a tu catalogo</a></button>
                <br><br>
                
                <button class="help-button-re"><a href="">Conoce a DHT22</a></button>
                <img src="assets/img/dht22" alt="dht22">

                <button class="ia-button-re"><a href="">GardenIA</a></button>



            </div>
        </div>
        
             
    </section>
    <script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>
</body>
</html>
