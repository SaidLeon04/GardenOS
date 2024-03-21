<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../assets/css/barra_lateral.css">
    <link rel="stylesheet" href="css/config_valores.css">
    <?php 
        include("../statements.php");
        include("../conexion.php");

        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];
        $id_lote = $_GET['id_lote'];
        
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

    <section class="home">
        <div class="text">
            <header>
                Establecer valores óptimos 
            <?php
                $stmt = $conexion->prepare($consulta_lote);
                $stmt->bind_param("i", $id_lote);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $info = $result->fetch_assoc();
                    $id_planta = $info['id_planta'];
                    $nombre_lote = $info['nombre_lote'];
                    $estado = $info['estado'];
                    $temperatura_optima = $info['temperatura_optima'];
                    $humedad_optima = $info['humedad_optima'];
                } else {
                    echo "El lote no existe";
                }
            ?>
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <form id="valores" enctype="multipart/form-data" method=POST action="editar_valores_optimos.php">
                        <input hidden readonly name="id_lote" value=<?php echo $id_lote; ?>>
                        <label for="nombre_lote" class="text">Nombre lote: </label>
                            <input type="text" id="nombre_lote" name="nombre_lote" value=<?php echo $nombre_lote; ?> readonly>
                            <br>
                        <label for="estado" class="text">Estado Actual: </label>
                            <input type="text" id="estado" name="estado" value=<?php echo $estado; ?> readonly>
                            <br>
                        <label for="temperatura" class="text">Temperatura óptima: </label>
                            <input type="text" id="temperatura" name="temperatura_optima" value=<?php echo $temperatura_optima; ?> readonly>
                            <br>
                        <label for="humedad" class="text">Humedad óptima: </label>
                            <input type="text" id="humedad" name="humedad_optima" value=<?php echo $humedad_optima; ?> readonly>
                            <br>   
                        <!--TODO riego || ocupas modificar la bd-->
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
<script src="../assets/js/barra_lateral.js"></script>
<script src="js/functions.js"></script>
</html>

