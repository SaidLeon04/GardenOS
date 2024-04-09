<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/fonts/font.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/plantas/css/view_planta.css">
    <link rel="stylesheet" href="/proyectos/garden_os/dev/assets/css/barra_lateral.css">
    <title>Detalles de Planta</title>
    <?php 
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_planta = $_GET['id_planta'];
        $stmt = $conexion->prepare("SELECT * FROM plantas WHERE id_planta = ?");
        $stmt->bind_param('i', $id_planta);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $planta = $result->fetch_assoc();
            $nombre = $planta['nombre'];
            $tipo = $planta['tipo'];
            $descripcion = $planta['descripcion'];
            $imagen = $planta['imagen'];
        } else {
            header("Location: ../error/planta_null.php");
        }

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
                <?php echo $nombre; ?>
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <img src="data:image;base64,<?php echo $imagen; ?>" alt="imagen_planta" id="imagen_planta">
            
                    <form id="planta" enctype="multipart/form-data" method=POST action="/proyectos/garden_os/planta/e">
                        <input name="id_planta" value="<?php echo $id_planta; ?>" readonly hidden>
                        <label for="nombre" class="text">Nombre: </label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" readonly>
                            <br>
                        <label for="nombre" class="text">Tipo: </label>
                            <p id="tipo_parrafo" class="parrafo"><?php echo $tipo; ?></p>
                            <select name="tipo" hidden id="selectTipo">
                                <option value="<?php echo $tipo; ?>" default><?php echo $tipo; ?></option>
                                <option value="hortaliza">Hortaliza</option>
                                <option value="flor">Flor</option> 
                                <option value="fruta">Fruta</option> 
                            </select>
                            <br>
                        <label for="nombre" class="text">Descripción: </label>
                            <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" readonly>
                            <br>
                        <label for="imagen" class="text" id="label-imagen" hidden>Imagen: </label>
                            <input type="file" name="imagen" accept="image/*" id="input-imagen" hidden>
                            <br>
                </div>
                <div class="actions">
                        <button class="create-button" id="btn-crear"><a href="/proyectos/garden_os/lotes/c?id_planta=<?php echo $id_planta; ?>">Crear Lote</a></button>
                        <button class="create-button" id="btn-guardar" onclick="return editarPlanta()" type="submit" hidden>Guardar</button>
                        <button class="edit-button" id="btn-edit" onclick="return editActive('planta')" type="button"><a href="#">Editar</a></button>
                        <button class="delete-button" id="btn-delete" onclick="return eliminarPlanta()"><a href="/proyectos/garden_os/planta/d?id_planta=<?php echo $id_planta; ?>">Eliminar Planta</a></button>
                        <button class="delete-button" id="btn-cancel" onclick="return editInactive('planta')" type="button" hidden><a href="#">Cancelar</a></button>
                    </form>
                </div>    
            </div>
        </center>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
<script src="/proyectos/garden_os/dev/assets/js/barra_lateral.js"></script>
<script src="/proyectos/garden_os/dev/plantas/js/functions.js"></script>
</html>

