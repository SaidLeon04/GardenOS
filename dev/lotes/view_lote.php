<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="css/view_lote.css">
    <?php 
        include("sql/lotes.php");
        include("../statements.php");
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_lote = $_GET['id_lote'];

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

        $stmt = $conexion->prepare($lote_one);
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
                        <a href="lotes.php">
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
                Información del lote   
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <!-- TODO can save all moves in a lot, like edit date = show it in history??? -->
                    <img src="data:image;base64,<?php echo $imagen; ?>" alt="imagen_lote" id="imagen_lote">
            
                    <form id="lote" enctype="multipart/form-data" method=POST action="crud/edit.php">
                        <p class="alert">Zona peligrosa. Editar aspectos del lote puede alterar cultivos reales.</p>
                        <input type="hidden" name="id_lote" value=<?php echo $id_lote; ?>>
                        <input type="hidden" name="id_usuario" value=<?php echo $id_usuario ?>>
                        <label for="nombre_lote" class="text">Nombre del lote: </label>
                            <input type="text" id="nombre_lote" name="nombre_lote" value=<?php echo $nombre_lote; ?> readonly>
                            <br>
                        <label for="cantidad_actual" class="text">Cantidad actual: </label>
                            <input type="text" id="cantidad_actual" name="cantidad_actual" value=<?php echo $cantidad_actual; ?> readonly>
                            <br>
                </div>
                <div class="actions">
                        <button class="create-button" id="btn-crear"><a href="../stats/actividad.php?id_lote=<?php echo $id_lote; ?>">Actividad</a></button>
                        <button class="create-button" id="btn-guardar" onclick="return editarLote()" type="submit" hidden>Guardar</button>
                        <button class="edit-button" id="btn-edit" onclick="return editActive('lote')" type="button"><a href="#">Editar</a></button>
                        <button class="delete-button" id="btn-delete" onclick="return eliminarLote()"><a href="crud/delete.php?id_lote=<?php echo $id_lote; ?>">Eliminar lote</a></button>
                        <button class="delete-button" id="btn-cancel" onclick="return editInactive('lote')" type="button" hidden><a href="#">Cancelar</a></button>
                    </form>
                </div>    
            </div>
        </center>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
<script src="../assets/js/barra_lateral.js"></script>
<script src="js/functions.js"></script>
</html>

