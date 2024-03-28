<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tus Plantas</title>
    <link rel="stylesheet" href="../../assets/css/barra_lateral.css"> 
    <link rel="stylesheet" href="../css/add.css">

    <?php 
        include("../../conexion.php");
        include("../../statements.php");
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $usuario = $_SESSION['nombre'];

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
                        <a href="../plantas.php" title="Ver catálogo de plantas">
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
                        <a href="../../sensores.php">
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
                Agrega una planta a tu catalogo
            </header>
        </div>
        <center>
            <div class="form-info">
                <div class="info">
                    <div>
                        <br><br>
                        <h3>Planta</h3>
                        <img src="../assets/img/grow.jpg" alt="" class="imagenForm">
                    </div>

                    <form action="../crud/add.php" method="POST" enctype="multipart/form-data">
                        <label for="nombre"  class="text">Nombre de la planta: </label>    
                            <input type="text" placeholder="Nombre" name="nombre" required><br>
                        <label for="tipo" class="text">Tipo: </label>
                            <select name="tipo" required>
                                <option value="Hortaliza">Hortaliza</option>
                                <option value="flor">Flor</option> 
                                <option value="Fruta">Fruta</option> 
                            </select>
                        <label for="descripcion"  class="text">Descripción: </label>
                            <textArea placeholder:"Descripción" name="descripcion" required></textArea>
                            
                        <label for="imagen"  class="text">Imagen: </label>
                            <input type="file" name="imagen">
                            <br>
                </div>
                <div class="actions">
                    <input type="submit" class="create-button" value="Guardar" name="guardar">
                    <button class="delete-button" type="button" ><a href="../plantas.php">Volver</a></button>
                    <button class="help-button" type="button" ><a href="help/instalacion_sensor.html">Ayuda</a></button>
                    </form>
                </div>  
            </div>
        </center>
    </section>
</body>
<script src="../../assets/js/barra_lateral.js"></script>
</html>

