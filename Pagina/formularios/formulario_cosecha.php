<!DOCTYPE html>
<html>
<head>
    <title>COSECHA</title>
        <link rel="stylesheet" type="text/css" href="../inicios/estilos_barra_lateral.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <meta charset="UTF-8">
    <style>
        .container {
            max-width: 300px;
            margin: 100px auto;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
            animation: fade 1s;
            background-image: linear-gradient(to bottom, #E59866, #FBEEE6);
        }

        .container:hover {
            transform: translateY(-5px);
        }

        @keyframes fade {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        h1 {
            color: #000000;
            font-size: 32px;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }

        h1:hover {
            color: #6E2C00;
            transform: scale(1.05);
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="submit"],
        select {
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus,
        input[type="submit"]:focus,
        select:focus {
            background-color: #F2D7D5;
            outline: none;
            transform: scale(1.05);
        }

        input[type="submit"]{
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-image: linear-gradient(to right, #E59866, #000000);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-image: linear-gradient(to right, #000000, #E59866);
            animation: pulse 1s infinite;
            transform: scale(1.05);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src=" ">
            </span>

            <div class="text logo-text">
                <span class="name">
                    <?php 
                        include("../conexion.php");
                        session_start();
                        $id_usuario = $_SESSION['id_usuario'];
                        echo $_SESSION['nombre'];
                    ?>
                </span>
            </div>
        </div>
            <span class="material-symbols-outlined toggle">
                chevron_right
            </span>
    </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    
                    <li class="nav-link">
                        <a href="../inicios/home.php" title="Volver al inicio">
                            <span class="material-symbols-outlined icon">
                                home
                            </span>
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../inicios/plantas.php" title="Ver catálogo de tus plantas">
                            <span class="material-symbols-outlined icon">
                                potted_plant
                            </span>
                            <span class="text nav-text">Plantas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../inicios/lotes.php">
                            <span class="material-symbols-outlined icon">
                                ballot
                            </span>
                            <span class="text nav-text">Lotes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../inicios/lotes_terminados.php">
                            <span class="material-symbols-outlined icon" style="color: blue;">
                                ballot
                            </span>
                            <span class="text nav-text">Lotes Terminados</span>
                        </a>
                    </li>    

                    <li class="nav-link">
                        <a href="../inicios/plagas.php">
                            <span class="material-symbols-outlined icon">
                                bug_report
                            </span>
                            <span class="text nav-text">
                                Plagas
                            </span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">

                <li class="nav-link">
                    <a href="../inicios/logout.php">
                        <span class="material-symbols-outlined icon">
                            logout
                            </span>
                        <span class="text nav-text">Salir</span>
                    </a>
                </li>

            </div>
        </div>
</nav>
<body>
    <div class="container">
            <h1>COSECHA</h1>
    <?php
        $id_lote = $_GET['id_lote'];
        $nombre_lote = $_GET['nombre_lote'];

    $consulta_fecha = "SELECT * FROM historial WHERE id_lote = '$id_lote' AND estado = 'crecimiento'";
    $resultado_consulta_fecha = mysqli_query($conexion,$consulta_fecha);
    while ($row = $resultado_consulta_fecha -> fetch_array()) {
        $fecha = $row['fecha'];
        $cantidad = $row['cantidad'];
    }
        ?>
        
    <form action="formulario_avance_action.php" method="POST">
        <input type="text" name="id_lote" hidden readonly value="<?php echo $id_lote; ?>">
        <label>Lote</label>
        <input type="text" name="nombre_lote" readonly value="<?php echo $nombre_lote; ?>">
        <label>Estado Actual</label>

    <div style="display: inline-flex;">
        <input type="text" name="estado" readonly value="crecimiento">
        <input type="text" name="cantidad" readonly value="<?php echo $cantidad; ?>">
   </div>
        <input type="text" name="fecha_inicio" readonly value="<?php echo $fecha;?>">
        
        
        <label>Siguiente Paso</label>

        <div style="display: inline-flex;">
        <input type="text" name="estado_nuevo" readonly value="cosecha">
        <input type="date" placeholder="Fecha" min="<?php echo $fecha ?>" max="2100-12-12" name="fecha_estado">
    </div>
        <input type="number" placeholder="Cantidad" name="cantidad_nuevo" min="1" max="<?php echo $cantidad?>">
        <input type="submit" value="Guardar" name="guardar">
    </form>
 
</div>
<script src="../inicios/script_barra_lateral.js"></script>
</body>
</html>
