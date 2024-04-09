<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/stats/css/config_valores.css">
    <?php 
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_lote = $_GET['id_lote'];
        
        $stmt = $conexion->prepare("SELECT imagen FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $pfp = $datos_usuario['imagen'];
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
                Establecer valores óptimos 
            <?php
                $stmt = $conexion->prepare("SELECT plantas.imagen, lote.nombre_lote, lote.estado, lote.temperatura_optima, lote.humedad_optima, lote.riego, lote.intervalo FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta WHERE plantas.id_usuario = ? AND id_lote = ?");
                $stmt->bind_param("ii", $id_usuario, $id_lote);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $info = $result->fetch_assoc();
                    $nombre_lote = $info['nombre_lote'];
                    $estado = $info['estado'];
                    $temperatura_optima = $info['temperatura_optima'];
                    $humedad_optima = $info['humedad_optima'];
                    $riego = $info['riego'];
                    $intervalo = $info['intervalo'];
                    $imagen = $info['imagen'];
                } else {
                    echo "El lote no existe";
                }

            ?>
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <div class="info1">
                        <form id="valores" method=POST action="/proyectos/garden_os/config_action">
                            <input hidden readonly name="id_lote" value=<?php echo $id_lote; ?>>
                            <label for="nombre_lote" class="texto">Nombre lote: </label>
                                <p class="parrafo"><?php echo $nombre_lote ?></p>
                                <br>
                            <label for="estado" class="texto">Estado Actual: </label>
                                <p class="parrafo"><?php echo $estado ?></p>
                                <br>
                            <img src="data:image;base64,<?php echo $imagen; ?>" alt="pfp" class="imagen">
                    </div>
                    <div class="info2">
                        <label for="temperatura" class="texto">Temperatura óptima: </label>
                            <div class="inputView"><input type="number" id="temperatura" name="temperatura_optima" value=<?php echo $temperatura_optima; ?> readonly required min=1 max=80><p class="texto">°C</p></div>
                            <br>
                        <label for="humedad" class="texto">Humedad óptima: </label>
                            <div class="inputView"><input type="number" id="humedad" name="humedad_optima" value=<?php echo $humedad_optima; ?> readonly required min=1 max=100><p class="texto">%</p></div>
                            <br>   
                        <label for="riego" class="texto">Riego con la humedad al: </label>
                            <div class="inputView"><input type="number" id="riego" name="riego" value="<?php echo $riego ?>" readonly required min=1 max=100><p class="texto">%</p></div>
                            <br>
                        <label for="riego" class="texto">Intervalo: </label>
                            <div class="inputView"><input type="number" id="intervalo" name="intervalo" value="<?php echo $intervalo ?>" readonly required min=1 max=1000><p class="texto">minutos</p></div>
                            <br>
                    </div>    
                </div>
                <div class="actions">
                        <button class="create-button" id="btn-comparar"><a href="../stats/comparar_valores.php">Comparar</a></button>
                        <button class="create-button" id="btn-guardar" onclick="return editarValores()" type="submit" hidden>Guardar</button>
                        <button class="edit-button" id="btn-edit" onclick="return editActive('valores')" type="button"><a href="#">Editar</a></button>
                        <button class="delete-button" id="btn-volver"><a href="actividad.php?nombre_lote=<?php echo $nombre_lote; ?>&id_lote=<?php echo $id_lote ; ?>">Volver</a></button>
                        <button class="delete-button" id="btn-cancel" onclick="return editInactive('valores')" type="button" hidden><a href="#">Cancelar</a></button>
                    </form>
                </div>    
            </div>
        </center>
    </section>
</body>
<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>
<script src="/proyectos/garden_os/dev/stats/js/functions.js"></script>
</html>

