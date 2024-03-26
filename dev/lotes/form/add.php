<!DOCTYPE html>
<html lang="es">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea un lote</title>
    <link rel="stylesheet" href="../../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="../css/add.css">
    <?php 
        include("../../conexion.php");
        include("../../statements.php");
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_planta = $_GET['id_planta'];
        $fecha_hoy = date('Y-m-d');


        # PFP Stuff
        $stmt = $conexion->prepare($consulta_pfp);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $pfp = $datos_usuario['imagen'];
            $result->free_result();
        }else{
            session_destroy();
            header("Location: ../login/login.php");
        }

        $stmt = $conexion->prepare($consulta_planta);
        $stmt->bind_param('i', $id_planta);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $planta = $result->fetch_assoc();
            $nombre = $planta['nombre'];
            $imagen = $planta['imagen'];
        } else {
            header("Location: ../error/planta_null.php");
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
                        <a href="../../perfil/view_perfil.php?id_usuario=<?php echo $id_usuario; ?>" class="pfp-link"><?php echo $usuario; ?></a>
                    </span>
                </div>
            </div>
                <img src="../../assets/svg/arrow.svg" alt="icono_arrow" class="toggle">
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="../../home/home.php" title="Volver al inicio">
                            <img src="../../assets/svg/home.svg" alt="icono_home" class="icon">
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../../plantas/plantas.php" title="Ver catálogo de plantas">
                            <img src="../../assets/svg/planta.svg" alt="icono_planta" class="icon">
                            <span class="text nav-text">Plantas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../lotes.php">
                            <img src="../../assets/svg/lotes.svg" alt="icono_lotes" class="icon">
                            <span class="text nav-text">Lotes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../../lotes_terminados/lotes_terminados.php">
                            <img src="../../assets/svg/lotes_terminados.svg" alt="icono_lotes" class="icon">
                            <span class="text nav-text">Lotes Terminados</span>
                        </a>
                    </li>  

                    <li class="nav-link">
                        <a href="../../sensores/sensores.php">
                            <img src="../../assets/svg/humedad.svg" alt="icono_humedad" class="icon">
                            <span class="text nav-text">Sensores</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../../zen/zen.php">
                            <img src="../../assets/svg/zen.svg" alt="icono_zen" class="icon">
                            <span class="text nav-text">
                                Zen
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="nav-link">
                    <a href="../../ayuda/ayuda.php">
                        <img src="../../assets/svg/help.svg" alt="icono_help" class="icon">
                        <span class="text nav-text">Ayuda</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="../../logout/logout.php">
                        <img src="../../assets/svg/logout.svg" alt="icono_logout" class="icon">
                        <span class="text nav-text">Salir</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>
    <section class="home">
        <div class="text">
            <header>
                Crea un lote
            </header>
        </div>

        <center>
            <div class="form-info">
                <div class="info">
                    <div>
                        <br><br>
                        <h2>Tu planta es: <?php echo $nombre; ?></h2>
                        <img src="data:image;base64,<?php echo $imagen; ?>" alt="planta" class="imagenForm">    
                    </div>


                    <form action="../crud/add.php" method="POST">
                        <input type="text" name="nombre_lote" placeholder="Nombre Lote">
                        <input type="text" name="id_planta" hidden value="<?php echo $id_planta ?>">
                        <input type="date" placeholder="Fecha" value="<?php echo $fecha_hoy ?>" name="fecha" min="<?php echo $fecha_hoy ?>">
                        <select name="estado">
                            <option value="germinacion">Germinación</option>
                            <option value="siembra">Siembra</option>
                            <option value="crecimiento">Crecimiento</option>
                            <option value="cosecha">Cosecha</option>
                        </select>  
                        <input type="number" placeholder="Cantidad" name="cantidad" min="1">
                </div>
            
                <div class="actions">
                    <input type="submit" name="guardar" value="Guardar" class="create-button">
                    <button class="delete-button"><a href="../../plantas/plantas.php">Cancelar</a></button>
                    <button class="help-button"><a href="../help/help.php">Ayuda</a></button>
                    </form>
                </div>
            </div>
        </center>
    </section>
</body>
<script src="../../assets/js/barra_lateral.js"></script>
</html>
 