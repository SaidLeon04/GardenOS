<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, init-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="../css/form.css">
    <?php 
        include("../../conexion.php");
        include("../../statements.php");
        session_start();
        $id_usuario = $_SESSION['id_usuario'];

        $stmt = $conexion->prepare($consulta_usuario);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $datos_usuario = $result->fetch_assoc();
            $imagen = $datos_usuario['imagen'];
        } else {
            echo "El usuario no existe";
        }

        $stmt = $conexion->prepare($lote_usuario);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $id_lote = [];
            $nombre_lote = [];
            $cantidad_registros = $result->num_rows;
            while ($info = $result->fetch_assoc()) {
                $id_lote[] = $info['id_lote'];
                $nombre_lote[] = $info['nombre_lote'];
            }
        } else {
            $nothing = "No hay lotes registrados";
        }
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
                        <a class="pfp-link" href="../../perfil/view_perfil.php?id_usuario=<?php echo $id_usuario; ?>"><?php echo $usuario; ?></a>
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
                        <a href="../../lotes/lotes.php">
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
                        <a href="../sensores.php">
                            <img src="../../assets/svg/humedad.svg" alt="icono_humedad" class="icon">
                            <span class="text nav-text">
                                Sensores
                            </span>
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
                Inicia un sensor
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <div>
                        <br><br>
                        <h3>DHT 22</h3>
                        <img src="../assets/img/dht22.png" alt="su_sensor.png" class="imagenForm">
                        <p>Sensor de humedad</p>
                    </div>
                    
            
                    <form id="sensor" method=POST action="../crud/add.php">
                        <label for="nombre" class="text">Nombre del sensor: </label>
                            <input type="text" name="nombre" placeholder="Identifica tu sensor" required maxlenght=50 minlenght=5>
                            <br>
                        <label for="tipo" class="text">Tipo de sensor: </label>
                        <select name="tipo" required>
                            <option value="dht22">DHT 22</option>
                            <option value="dht11">DHT 11</option> 
                        </select>
                            <br>
                        <label for="lote" class="text">Lote Asociado: </label>
                        <select name="lote" required>
                            <option value="" default>Selecciona un lote</option>
                            <?php
                                for ($i = 0; $i < $cantidad_registros; $i++) {
                                    echo "<option value='".$id_lote[$i]."'>".$nombre_lote[$i]."</option>";
                                }
                            ?>
                        </select>
                            <br>
                        <label for="url_conexion" class="text">URL de conexión: </label>
                            <input type="text" name="url_conexion" placeholder="URL de conexión" required maxlenght=50 minlenght=5>
                            <br>

                        
                </div>
                <div class="actions">
                        <button class="create-button"  type="submit">Guardar</button>
                        <button class="delete-button" type="button" ><a href="../sensores.php">Volver</a></button>
                        <button class="help-button" type="button" ><a href="help/instalacion_sensor.html">¿Cómo instalar?</a></button>
                        
                    </form>
                </div>    
            </div>
        </center>
    
    </section>
</body>
<script src="../../assets/js/barra_lateral.js"></script>

</html>

