<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="view_perfil.css">
    <?php 
        include("../statements.php");
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_usuario = $_GET['id_usuario'];
    ?>
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
                        <a href="plantas.php" title="Ver catálogo de plantas">
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
    <?php
        $stmt = $conexion->prepare($consulta_usuario);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $nombre = $usuario['nombre'];
            $correo = $usuario['correo'];
            $dias_str = $usuario['dias'];
            $imagen = $usuario['imagen'];
        } else {
            echo "El usuario no existe";
        }

        $fecha_inicial = new DateTime($dias_str);
        $fecha_actual = new DateTime();
        $diferencia = $fecha_inicial->diff($fecha_actual);
        $dias = $diferencia->days;
    ?>
    <section class="home">
        <div class="text">
            <header>
                Perfil de GardenOS 
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <img src="data:image;base64,<?php echo $imagen; ?>" alt="imagen_usuario" id="imagen_usuario">
            
                    <form id="usuario" enctype="multipart/form-data" method=POST action="">
                        <input type="hidden" name="id_planta" value=<?php echo $id_usuario; ?>>
                        <label for="nombre" class="text">Nombre: </label>
                            <input type="text" id="nombre" name="nombre" value=<?php echo $nombre; ?> readonly>
                            <br>
                        <label for="nombre" class="text">Correo: </label>
                            <input type="text" id="correo" name="correo" value=<?php echo $correo; ?> readonly>
                            <br>
                        <label for="nombre" class="text">Días: </label>
                            <input type="text" id="dias" name="dias" value=<?php echo $dias; ?> readonly>
                            <br>
                        <label for="imagen" class="text" id="label-imagen" hidden>Imagen: </label>
                            <input type="file" name="imagen" accept="image/*" id="input-imagen" hidden>
                            <br>
                </div>
                <div class="actions">
                        <button class="create-button" id="btn-editar" onclick="return editActive('usuario')" type="button"><a href="#">Editar perfil</a></button>
                        <button class="create-button" id="btn-guardar" onclick="return saveData()" type="submit" hidden>Guardar</button>
                        <button class="edit-button" id="btn-passwd" onclick="return changePasswd()"><a href="passwd_form.php">Cambiar contraseña</a></button>
                        <button class="delete-button" id="btn-delete" onclick="return deleteUser()"><a href="borrar_perfil.php?id_usuario=<?php echo $id_usuario; ?>">Eliminar Perfil</a></button>
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

