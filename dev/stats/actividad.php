<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">  
    <link rel="stylesheet" href="css/stats.css">
    <?php 
        include("../conexion.php");
        include("../statements.php");
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $nombre_lote = $_GET['nombre_lote'];
        $id_lote = $_GET['id_lote'];
    ?>
    <title>Dashboard <?php echo $nombre_lote; ?></title>
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../assets/img/clean.png" alt="pfp.jpg">
                </span>

                <div class="text logo-text">
                    <span class="name">
                    <?php
				        echo $usuario;
                    ?>
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
                        <a href="../lotes/  lotes.php">
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
            <!-- Consultas aquí -->
            <?php
                $stmt = $conexion->prepare($consulta_join);
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $info = $result->fetch_assoc();
                    $id_planta = $info['id_planta'];
                    $nombre_planta = $info['nombre'];
                    $imagen = $info['imagen'];
                    $tipo = $info['tipo'];
                    $id_sensor = $info['id_sensor'];
                    $fecha_inicial_str = $info['fecha_inicial'];
                    $cantidad_actual = $info['cantidad_actual'];
                    $estado = $info['estado'];
                    $temperatura_optima = $info['temperatura_optima'];
                    $humedad_optima = $info['humedad_optima'];
                } else {
                    echo "La planta no existe";
                }
                # date stuff
                $fecha_inicial = new DateTime($fecha_inicial_str);
                $fecha_actual = new DateTime();
                $diferencia = $fecha_inicial->diff($fecha_actual);
                $dias = $diferencia->days;
            ?>
        <center>
        <div class="main-container">
            <div class="general">
                <div class="carta-stats">
                    <h3>Días Totales</h3>
                    <?php 
                        
                        echo $dias;
                    ?>
                </div>
                <div class="carta-stats">
                    <h3>Cantidad Actual</h3>
                    <?php echo $cantidad_actual ?>
                </div>
                <div class="carta-stats">
                    <h3>Proceso Actual</h3>
                    <?php echo $estado ?>
                </div>
                <div class="carta-stats">
                    <h3>Previsión</h3>
                    <?php #TODO consulta para obtener dias ?>
                </div>
            </div>

            <div class="valores">
                <div class="valores-optimos">
                    <div class="title">
                        <h3 class="optimos-titulo">Valores Optimos</h3>
                        <button class="edit-button"><a href="config_valores.php?id_lote=<?php echo $id_lote; ?>">Establecer</a></button>
                    </div>
                    <div class="nums">
                        <?php
                            if ($temperatura_optima == 0 || $humedad_optima == 0) {
                                echo "No hay valores óptimos establecidos correctamente.";
                            }else {
                                echo "Temperatura: " . $temperatura_optima . "°C";
                                echo "Humedad: " . $humedad_optima . "%";
                            }
                        ?>
                    </div> 
                </div>

                <div class="valores-actuales">
                    <div class="title">
                        <h3 class="actuales-titulo">Valores Actuales</h3>
                    </div>
                    <div class="nums">
                        <?php
                            if (is_null($id_sensor)) {
                                echo "No hay un sensor conectado.";
                            } else {
                                echo "Sensor conectado correctamente";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="foot">
                <div class="table-container">
                    <div class="table-controls">
                        <div class="titulo-tabla">Humedad</div>
                        <div class="controles-tabla">
                            <button class="btn"><</button>
                            <button class="btn">></button>
                        </div>
                    </div>
                    <table border="2px">

                    </table>

                </div>

                <div class="controls">
                    <button class="btn">Avanzar al siguiente paso</button>
                    <button class="btn">Historial</button>
                    <button class="btn">IA</button>
                </div>
            </div>
        </div>
        
            
        </center>
    </section>
</body>
<script src="../assets/js/barra_lateral.js"></script>
</html>