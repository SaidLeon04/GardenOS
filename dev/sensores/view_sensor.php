<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/sensores/css/view_sensor.css"> 
    <?php 
        include("../statements.php");
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_sensor = $_GET['id_sensor'];

        $stmt = $conexion->prepare($consulta_usuario);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $pfp = $datos_usuario['imagen'];
        } else {
            echo "El usuario no existe";
        }
        
        $stmt = $conexion->prepare("SELECT * FROM sensores WHERE id_sensor = ? AND id_usuario = ?");
        $stmt->bind_param('ii',$id_sensor, $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                $id_sensor = $row['id_sensor'];
                $id_lote = $row['id_lote'];
                $nombre_sensor = $row['nombre'];
                $valor = $row['valor'];
                $tipo = $row['tipo'];
                $url_conexion = $row['url_conexion'];  
        } else {
            header("Location: ../error/sensor_nulo.php");
        }

        $stmt = $conexion->prepare("SELECT nombre_lote FROM lote WHERE id_lote = ? AND id_sensor = ?");
        $stmt->bind_param('ii', $id_lote, $id_sensor);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $lote = $result->fetch_assoc();
            $nombre_lote = $lote['nombre_lote']; 
            $code = 0; 
        } else {
            $nombre_lote = "No esta asociado a ningún lote";
            $code = 1;
        }     

        $stmt = $conexion->prepare("SELECT id_lote, nombre_lote FROM lote WHERE id_usuario = ? AND estado != 'finalizado' AND id_sensor = 0");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $id_lote = [];
            $nombre_lote_select = [];
            $cantidad_registros = $result->num_rows;
            while ($info = $result->fetch_assoc()) {
                $id_lote[] = $info['id_lote'];
                $nombre_lote_select[] = $info['nombre_lote'];
            }
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
                Información del sensor: <?php echo $nombre_sensor;?>  
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <?php
                        if ($tipo == "dht22") {
                            echo "<img src='/proyectos/garden_os/dev/sensores/assets/img/dht22.png' alt='sensor_dht22' id='imagenSensor'>";
                        }elseif ($tipo == "dht11"){
                            echo "<img src='/proyectos/garden_os/dev/sensores/assets/img/dht11.png' alt='sensor_dht11' id='imagenSensor'>";
                        }
                    ?>
            
                    <form id="sensor" method=POST action="/proyectos/garden_os/sensor/e">
                        <input type="hidden" name="id_sensor" value=<?php echo $id_sensor; ?>>
                        <label for="nombre_sensor" class="text">Nombre del sensor: </label>
                            <p class="parrafo"><?php echo $nombre_sensor; ?></p>
                            <input type="text" id="nombre_sensor" name="nombre_sensor" value=<?php echo $nombre_sensor; ?> required hidden>
                         
                        <label for="nombre_lote" class="text">En lote: </label>
                            <p class="parrafo"><?php echo $nombre_lote; ?></p>
                            <select name="nombre_lote" id="select_lote" required hidden>
                                <option value="" default>Selecciona un lote</option>
                                <?php
                                    for ($i = 0; $i < $cantidad_registros; $i++) {
                                        echo "<option value='".$id_lote[$i]."'>".$nombre_lote_select[$i]."</option>";
                                    }
                                ?>
                            </select>
            
                        <label for="tipo" class="text">Tipo: </label>
                            <p class="parrafo"><?php echo $tipo; ?></p>
                            <select name="tipo" id="select_tipo" required hidden>
                                <option value="<?php echo $tipo ?>" default><?php echo $tipo ?></option>
                                <option value="dht22">DHT22</option>
                                <option value="dht11">DHT11</option>
                            </select>
               
                        <label for="url" class="text">URL de conexión: </label>
                            <p class="parrafo"><?php echo $url_conexion; ?></p>
                            <input type="text" id="url" name="url" value=<?php echo $url_conexion; ?> required hidden>
                            <br>
                </div>
                <div class="actions">
                    <?php if ($code == 1) { ?>
                            <button class='create-button' id='btn-vincular' onclick="return editActive('sensor')" type='button'>Vincular</button>
                    <?php }else{ ?>
                             <button class='delete-button' id='btn-desvincular' onclick='return desvincularSensor()' type='button'><a href="/proyectos/garden_os/sensor/desvicular?key=<?php echo $id_sensor ?>">Desvincular</a></button>
                    <?php } ?>
                        
                        <button class="create-button" id="btn-guardar" onclick="return editarSensor()" type="submit" hidden>Guardar</button>
                        <button class="delete-button" id="btn-delete" onclick="return eliminarSensor()" type="button"><a href="/proyectos/garden_os/sensor/d?key=<?php echo $id_sensor; ?>">Eliminar sensor</a></button>
                        <button class="delete-button" id="btn-cancel" onclick="return editInactive('sensor')" type="button" hidden><a href="#">Cancelar</a></button>
                    </form>
                </div>    
            </div>
        </center>
    </section>
</body>

<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>
<script src="/proyectos/garden_os/dev/sensores/js/functions.js"></script>
</html>

