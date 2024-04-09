<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, init-scale=1.0">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/sensores/css/sensores.css"> 
    <?php 
        include("../conexion.php");

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

        $stmt = $conexion->prepare("SELECT * FROM sensores WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $id_sensor = [];
            $id_lote = [];
            $nombre = [];
            $tipo = [];
            $cantidad_registros = $result->num_rows;
            while ($info = $result->fetch_assoc()) {
                $id_sensor[] = $info['id_sensor'];
                $id_lote[] = $info['id_lote'];
                $nombre[] = $info['nombre'];
                $tipo[] = $info['tipo'];
                $valor[] = $info['valor'];
            }
        } else {
            $nothing = "No hay sensores registrados";
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
                Sensores registrados
                <button class="create-button"><a href="/proyectos/garden_os/sensores/c">Agregar Sensor</a></button>
            </header>
        </div>
        
        <div class="main-container">
            <?php
                $registros_impresos = 0;
                $contador_grupo = 0;
            ?>
            <div class="group-tile">
                <?php for ($i = 0; $i < $cantidad_registros; $i++) {
                    $stmt = $conexion->prepare("SELECT nombre_lote FROM lote WHERE id_lote = ? AND id_sensor = ?");
                    $stmt->bind_param('ii', $id_lote[$i], $id_sensor[$i]);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $lote = $result->fetch_assoc();
                        $nombre_lote = $lote['nombre_lote'];    
                    } else {
                        $nombre_lote = "No esta asociado a ningún lote";
                    }
                ?>
                <div class="lote-tile">
                    <a href="/proyectos/garden_os/sensor/v?id_sensor=<?php echo $id_sensor[$i]; ?>" class="tile-link">
                        <center>
                            <h1><?php echo $nombre[$i]; ?></h1>
                        
                            <?php
                                if ($tipo[$i] == "dht22") {
                                    echo "<img src='/proyectos/garden_os/dev/sensores/assets/img/dht22.png' alt='sensor_dht22' class='img-tile'>";
                                }elseif ($tipo[$i] == "dht11"){
                                    echo "<img src='/proyectos/garden_os/dev/sensores/assets/img/dht11.png' alt='sensor_dht11' class='img-tile'>";
                                }
                            ?>

                            <h2><?php echo $tipo[$i]; ?></h2>
                            
                            <h2>Conectado a: <?php echo $nombre_lote; ?></h2>
                        </center>
                    </a>
                </div>
                <?php
                $registros_impresos++;
                $contador_grupo++;
                if ($contador_grupo == 3 && $i < $cantidad_registros - 1) {
                    echo '</div>';
                    echo '<div class="group-tile">';
                    $contador_grupo = 0; 
                }
            } ?>
        </div>
    </section>
</body>
<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>

</html>

