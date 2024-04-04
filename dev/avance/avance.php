<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">  
    <link rel="stylesheet" href="css/avance.css">
    <title>Historial</title>

    <?php
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_lote = $_GET['key'];

        
        $stmt = $conexion->prepare("SELECT imagen FROM usuarios WHERE id_usuario = ?");
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $pfp = $datos_usuario['imagen'];
        } else {
            header("Location: ../login/login.php");
        }

        $stmt = $conexion->prepare("SELECT * FROM lote WHERE id_usuario = ? AND id_lote = ?");
        $stmt->bind_param('ii',$id_usuario, $id_lote);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $lote = $result->fetch_assoc();
            $id_lote = $lote['id_lote'];
            $id_planta = $lote['id_planta'];
            $nombre_lote = $lote['nombre_lote'];
            $fecha_inicial = $lote['fecha_inicial'];
            $cantidad_actual = $lote['cantidad_actual'];
            $estado = $lote['estado'];
        } else {
            echo "EL lote no existe";
        }

        $stmt = $conexion->prepare("SELECT imagen FROM plantas WHERE id_planta = ?");
        $stmt->bind_param('i', $id_planta);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_planta = $result->fetch_assoc();
            $imagen_planta = $datos_planta['imagen'];
        } else {
            echo "La planta no existe";
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
                Avanza al siguiente paso.
            </header>
        </div>
        <center>
            <div class="form-info">
                <p class="alert">La atualización de datos no eliminara los datos actuales. <br>Los datos siempre estaran disponibles en el historial</p>
                <div class="info">
                    <div>
                        <h3>Datos actuales: </h3>
                        <label for="nombre" class="text">Nombre del lote: </label>
                            <p class="parrafo" name="nombre_lote"><?php echo $nombre_lote ?></p>
                        <label for="correo" class="text">Fecha limite: </label>
                            <p class="parrafo" name="correo"><?php echo $fecha_inicial ?></p>
                        <label for="dias" class="text">Cantidad actual: </label> 
                            <p class="parrafo" name="dias"><?php echo $cantidad_actual ?></p>
                        <label for="estado" class="text">Estado: </label>
                            <p class="parrafo" name="estado"><?php echo $estado ?></p>
                    </div>
                    <div>
                        <h3>Datos nuevos: </h3>
                        <form id="avance" method=POST action="crud/avance.php">
                            <input type="hidden" name="id_lote" value="<?php echo $id_lote ?>">
                            <label for="fecha" class="text">Fecha del avance</label>
                                <input type="date" id="fecha" name="fecha" required value="<?php echo $fecha_hoy = date('Y-m-d'); ?>" readonly>
                            <label for="cantidad" class="text">Cantidad nueva: </label>
                                <input type="number" id="cantidad" name="cantidad" required max="<?php echo $cantidad_actual ?>" min= 0>
                            <label for="estado" class="text">Estado: </label>
                                <select name="estado" id="estado" required>
                                    <?php 
                                    if ($estado == "germinacion") {
                                        echo "<option value='siembra'>Siembra</option>";
                                        echo "<option value='crecimiento'>Crecimiento</option>";
                                        echo "<option value='cosecha'>Cosecha</option>";
                                    } elseif ($estado == "siembra") {
                                        echo "<option value='crecimiento'>Crecimiento</option>";
                                        echo "<option value='cosecha'>Cosecha</option>";
                                    } elseif ($estado == "crecimiento") {
                                        echo "<option value='cosecha'>Cosecha</option>";
                                    } elseif ($estado == "cosecha") {
                                        echo "<option value='finalizado'>Terminar Lote</option>";
                                    }
                                    ?>
                                </select>
                    </div>
                    
                        
                </div>
                <div class="actions">
                        <button class="create-button" onclick="return saveData()" type="submit">Guardar estado</button>
                        <button class="delete-button" type="button"><a href="../stats/actividad.php?id_lote=<?php echo $id_lote ?>">Volver</a></button>
                        <button class="help-button" type="button"><a href="../ayuda/">Ayuda</a></button>
                    </form>
                </div>    
            </div>
        </center>
  
    </section>
</body>
<script src="../assets/js/barra_lateral.js"></script>
</html>