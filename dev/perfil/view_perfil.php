<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="view_perfil.css">
    <title>Perfil</title>
    <?php 
        include("../statements.php");
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];

        $stmt = $conexion->prepare($consulta_usuario);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $nombre = $datos_usuario['nombre'];
            $correo = $datos_usuario['correo'];
            $dias_str = $datos_usuario['dias'];
            $imagen = $datos_usuario['imagen'];
        } else {
            echo "El usuario no existe";
        }

        $fecha_inicial = new DateTime($dias_str);
        $fecha_actual = new DateTime();
        $diferencia = $fecha_inicial->diff($fecha_actual);
        $dias = $diferencia->days;
    ?>
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="data:image;base64,<?php echo $imagen; ?>" alt="pfp" id="pfp">
                </span>

                <div class="text logo-text">
                    <span class="name">
                        <a class="pfp-link" href="view_perfil.php?id_usuario=<?php echo $id_usuario; ?>"><?php echo $usuario; ?></a>
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
                Perfil de GardenOS 
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <img src="data:image;base64,<?php echo $imagen; ?>" alt="imagen_usuario" id="imagen_usuario" class="imagenForm">
            
                    <form id="usuario" enctype="multipart/form-data" method=POST action="crud/editar_perfil.php">
                        <label for="nombre" class="text">Nombre: </label>
                            <input type="text" id="nombre" name="nombre" value=<?php echo $nombre ?> readonly>
                        <label for="correo" class="text">Correo: </label>
                            <p class="parrafo" name="correo"><?php echo $correo ?></p>
                        <label for="dias" class="text">Días: </label> 
                            <p class="parrafo" name="dias"><?php echo $dias ?></p>
                        <label for="imagen" class="text" id="label-imagen" hidden>Imagen: </label>
                            <input type="file" name="imagen" accept="image/*" id="input-imagen" hidden>
                            <br>
                </div>
                <div class="actions">
                        <button class="create-button" id="btn-editar" onclick="return editActive('usuario')" type="button"><a href="#">Editar perfil</a></button>
                        <button class="create-button" id="btn-guardar" onclick="return saveData()" type="submit" hidden>Guardar</button>
                        <button class="edit-button" id="btn-passwd"><a href="form/passwd_form.php">Cambiar contraseña</a></button>
                        <button class="edit-button" id="btn-email"><a href="form/email_form.php">Cambiar correo</a></button>
                        <button class="delete-button" id="btn-delete"><a href="form/delete_form.php">Eliminar Perfil</a></button>
                        <button class="delete-button" id="btn-cancel" onclick="return editInactive('usuario')" type="button" hidden><a href="#">Cancelar</a></button>
                    </form>
                </div>    
            </div>
        </center>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
<script src="../assets/js/barra_lateral.js"></script>
<script src="view_perfil.js"></script>
</html>

