<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, init-scale=1.0">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="css/sensores.css">
    <?php 
        include("../conexion.php");
        include("../statements.php");
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];

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

        $stmt = $conexion->prepare($sensores_usuario);
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
                        <a href="sensores.php">
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
                Sensores registrados
                <button><a href="form/add.php">Agregar Sensor</a></button>
            </header>
        </div>
        
        <div class="main-container">
            <?php
                $registros_impresos = 0;
                $contador_grupo = 0;
            ?>
            <div class="group-tile">
                <?php for ($i = 0; $i < $cantidad_registros; $i++) {
                    $stmt = $conexion->prepare("SELECT nombre_lote FROM lote WHERE id_lote = ?");
                    $stmt->bind_param('i', $id_lote[$i]);
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
                    <a href="view_sensor.php?id_sensor=<?php echo $id_sensor[$i]; ?>" class="tile-link">
                        <center>
                            <h3><?php echo $nombre[$i]; ?></h3>
                        
                            <img src="assets/img/dht22.png" alt="imagen_planta" class="img-tile">

                            <p><?php echo $tipo[$i]; ?></p>
                            <p><?php echo $valor[$i] ?></p>
                            <h4>Conectado a: <?php echo $nombre_lote; ?></h4>
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
<script src="../assets/js/barra_lateral.js"></script>

</html>

