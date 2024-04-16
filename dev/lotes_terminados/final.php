<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/lotes_terminados/css/final.css">
    <title>Estadisticas Finales</title>

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
                Estadisticas finales del lote: <?php echo $nombre_lote;?>  
                <button class="help-button">Ayuda</button>
            </header>
        </div>
        <center>  
            <div class="main">
                <div class="cont1">
                    <div>
                        <h2>Humedad</h2>
                    </div>
                    <div class="datos-temperatura">
                        <div>
                            <table id="tablaHumedad">
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
                        </div>
                        <div class="grafica">
                            <canvas id="graficaHumedad" ></canvas>
                        </div>
                    </div>
                    
                </div>
            
                <div class="cont2">
                    <div>
                        <h2>Temperatura</h2>
                    </div>
                    <div class="datos-humedad">
                        <div>
                            <table id="tablaTemperatura">
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
                        <div class="grafica">
                            <canvas id="graficaTemperatura"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>
<script src="/proyectos/garden_os/dev/stats/js/graficaHumedad.js"></script>
<script src="/proyectos/garden_os/dev/stats/js/graficaTemperatura.js"></script>
</html>
