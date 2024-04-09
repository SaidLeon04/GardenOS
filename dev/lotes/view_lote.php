<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/lotes/css/view_lote.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <title>Lote</title>
    <?php
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_lote = $_GET['id_lote'];

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

        $stmt = $conexion->prepare("SELECT plantas.nombre, plantas.imagen, lote.nombre_lote, lote.fecha_inicial, lote.cantidad_actual FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta WHERE plantas.id_usuario = ? AND id_lote=?");
        $stmt->bind_param('ii',$id_usuario, $id_lote);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $lote = $result->fetch_assoc();
            $nombre_planta = $lote['nombre'];
            $imagen = $lote['imagen'];
            $nombre_lote = $lote['nombre_lote'];
            $fecha_inicial = $lote['fecha_inicial'];
            $cantidad_actual = $lote['cantidad_actual'];      
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
                Información del lote   
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <!-- TODO can save all moves in a lot, like edit date = show it in history??? -->
                    <img src="data:image;base64,<?php echo $imagen; ?>" alt="imagen_lote" id="imagen_lote">
            
                    <form id="lote" enctype="multipart/form-data" method=POST action="/proyectos/garden_os/lote/e">
                        <p class="alert">Zona peligrosa. Editar aspectos del lote puede alterar cultivos reales.</p>
                        <input type="hidden" name="id_lote" value=<?php echo $id_lote; ?>>
                        <input type="hidden" name="id_usuario" value=<?php echo $id_usuario ?>>
                        <label for="nombre_lote" class="text">Nombre del lote: </label>
                            <input type="text" id="nombre_lote" name="nombre_lote" value="<?php echo $nombre_lote ?>" readonly>
                            <br>
                        <label for="cantidad_actual" class="text">Cantidad actual: </label>
                            <input type="text" id="cantidad_actual" name="cantidad_actual" value=<?php echo $cantidad_actual; ?> readonly>
                            <br>
                </div>
                <div class="actions">
                        <button class="create-button" id="btn-crear"><a href="/proyectos/garden_os/dashboard?id_lote=<?php echo $id_lote; ?>">Actividad</a></button>
                        <button class="create-button" id="btn-guardar" onclick="return editarLote()" type="submit" hidden>Guardar</button>
                        <button class="edit-button" id="btn-edit" onclick="return editActive('lote')" type="button"><a href="#">Editar</a></button>
                        <button class="delete-button" id="btn-delete" onclick="return eliminarLote()"><a href="/proyectos/garden_os/lote/d?id_lote=<?php echo $id_lote; ?>">Eliminar lote</a></button>
                        <button class="delete-button" id="btn-cancel" onclick="return editInactive('lote')" type="button" hidden><a href="#">Cancelar</a></button>
                    </form>
                </div>    
            </div>
        </center>
    </section>
</body>
<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>
<script src="/proyectos/garden_os/dev/lotes/js/functions.js"></script>
</html>

