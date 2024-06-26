<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, init-scale=1.0">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/lotes/css/lotes.css">
    <title>Lotes</title>
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

        $stmt = $conexion->prepare("SELECT plantas.id_planta, plantas.nombre, plantas.tipo, plantas.imagen, lote.id_lote, lote.id_sensor, lote.nombre_lote, lote.fecha_inicial, lote.cantidad_actual, lote.estado, lote.temperatura_optima, lote.humedad_optima FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta WHERE plantas.id_usuario = ? AND estado != 'finalizado' GROUP BY nombre_lote");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $id_lote = [];
            $id_planta = [];
            $nombre_planta = [];
            $tipo = [];
            $imagen = [];
            $nombre_lote = [];
            $estado = [];
            $cantidad_actual = [];
            $fecha_inicial = [];
            $cantidad_registros = $result->num_rows;
            while ($info = $result->fetch_assoc()) {
                $id_lote[] = $info['id_lote'];
                $id_planta[] = $info['id_planta'];
                $nombre_planta[] = $info['nombre'];
                $tipo[] = $info['tipo'];
                $nombre_lote[] = $info['nombre_lote'];
                $estado[] = $info['estado'];
                $cantidad_actual[] = $info['cantidad_actual'];
                $fecha_inicial[] = $info['fecha_inicial'];
                $imagen[] = $info['imagen'];
            }
        }else{
            echo "No hay lotes activos";
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
                Lotes Activos
            </header> 
        </div>
        
        <div class="main-container">
            <?php
                $registros_impresos = 0;
                $contador_grupo = 0;
            ?>
            <div class="group-tile">
                <?php for ($i = 0; $i < $cantidad_registros; $i++) { ?>
                <div class="lote-tile">
                    <a href="/proyectos/garden_os/lote/v?id_lote=<?php echo $id_lote[$i]; ?>" class="tile-link">
                        <center>
                            <h3><?php echo $nombre_lote[$i]; ?></h3>
                        
                            <img src="data:image;base64,<?php echo $imagen[$i]; ?>" alt="imagen_planta" class="img-tile">
                            <?php
                                $fecha_traducida = strftime('%A, %d de %B de %Y', strtotime($fecha_inicial[$i]));
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
                            ?>

                            <p>Planta: <?php echo $nombre_planta[$i]; ?></p>
                            <p>Estado actual: <?php echo $estado[$i]; ?></p>
                            <p>Cantidad actual: <?php echo $cantidad_actual[$i]; ?></p>
                            <p>Activo desde: <?php echo $fecha_traducida ?></p>
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
