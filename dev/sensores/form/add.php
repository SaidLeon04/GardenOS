<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, init-scale=1.0">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/sensores/css/form.css"> 
    <title>Agregar un sensor</title>
    <?php 
        include("../../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];

        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $pfp = $datos_usuario['imagen'];
        } else {
            echo "El usuario no existe";
        }

        $stmt = $conexion->prepare("SELECT * FROM lote WHERE id_usuario = ? AND estado != 'finalizado' AND id_sensor = 0");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $id_lote = [];
            $nombre_lote = [];
            $cantidad_registros = $result->num_rows;
            while ($info = $result->fetch_assoc()) {
                $id_lote[] = $info['id_lote'];
                $nombre_lote[] = $info['nombre_lote'];
            }
        } else {
            $nothing = "No hay lotes registrados";
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
                Inicia un sensor
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <div>
                        <br><br>
                        <h3>DHT 22</h3>
                        <img src="/proyectos/garden_os/dev/sensores/assets/img/dht22.png" alt="su_sensor.png" class="imagenForm">
                        <p>Sensor de humedad</p>
                    </div>
                    
            
                    <form id="sensor" method=POST action="/proyectos/garden_os/dev/sensores/crud/add.php">
                        <label for="nombre" class="text">Nombre del sensor: </label>
                            <input type="text" name="nombre" placeholder="Identifica tu sensor" required maxlenght=50 minlenght=5>
                            <br>
                        <label for="tipo" class="text">Tipo de sensor: </label>
                        <select name="tipo" required>
                            <option value="dht22">DHT 22</option>
                            <option value="dht11">DHT 11</option> 
                        </select>
                            <br>
                        <label for="lote" class="text">Lote Asociado: </label>
                        <select name="lote" required>
                            <option value="" default>Selecciona un lote</option>
                            <?php
                                for ($i = 0; $i < $cantidad_registros; $i++) {
                                    echo "<option value='".$id_lote[$i]."'>".$nombre_lote[$i]."</option>";
                                }
                            ?>
                        </select>
                            <br>
                        <label for="url_conexion" class="text">URL de conexión: </label>
                            <input type="text" name="url_conexion" placeholder="URL de conexión" required maxlenght=50 minlenght=5>
                            <br>

                        
                </div>
                <div class="actions">
                        <button class="create-button"  type="submit">Guardar</button>
                        <button class="delete-button" type="button" ><a href="/proyectos/garden_os/sensores">Volver</a></button>
                        <button class="help-button" type="button" ><a href="help/instalacion_sensor.html">¿Cómo instalar?</a></button>
                        
                    </form>
                </div>    
            </div>
        </center>
    
    </section>
</body>
<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>

</html>

