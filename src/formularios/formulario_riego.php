<!DOCTYPE html>
<html>
<head>
    <title>RIEGO</title>
    <body bgcolor="#CCD1D1">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../inicios/estilos_barra_lateral.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
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
            background-image: linear-gradient(to bottom, #B2BABB, #F2F4F4);
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
            color: #424949;
            transform: scale(1.05);
        }

        input[type="text"],
        input[type="number"],
        input[type="time"],
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
        input[type="number"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="submit"]:focus,
        select:focus {
            background-color: #E5E8E8;
            outline: none;
            transform: scale(1.05);
        }

        input[type="submit"] {
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-image: linear-gradient(to right, #B2BABB, #000000);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-image: linear-gradient(to right, #000000, #B2BABB);
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
<body>
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

<div class="container">
    <h1>RIEGO</h1>
    <form action="formulario_riego_action.php" method="POST" name="form">
        <?php 

            $id_lote = $_GET['id_lote'];
            $nombre_lote = $_GET['nombre_lote'];



            $consulta_fecha = "SELECT fecha FROM historial WHERE id_lote = '$id_lote' GROUP BY id_historial DESC LIMIT 1;";
            $resultado_fecha = mysqli_query($conexion,$consulta_fecha);
            while($row = $resultado_fecha->fetch_array()){
                $fecha_estado = $row['fecha'];
            }
        ?>
        <input type="number" name="id_lote" readonly value="<?php echo $id_lote ?>" hidden>  
        <input type="text" readonly value="<?php echo $nombre_lote ?>"> 
    <div id="times">
        <input type="date" placeholder="Fecha" min="<?php echo $fecha_estado ?>" max="2100-12-12" name="fecha" id="fecha">
        <input type="time" placeholder="Hora" name="hora">
    </div>

        <input type="number" placeholder="Duracion (minutos)" name="duracion" min="1">
    <div style="display: inline-flex;"> 
        <input type="number" placeholder="Cantidad" name="cantidad_agua" min="1">
        <select name="unidad">
            <option value="mililitros">Mililitros</option>
            <option value="litros">Litros</option>
            <option value="galones">Galones</option>
        </select> 
    </div>
        <input type="number" placeholder="PH Agua" name="ph_agua" min="0">
        <input type="submit" value="Guardar" name="guardar">
        <input type="submit" name="ahora" value="Fecha y hora actual">
    </form>

</div>
<script src="../inicios/script_barra_lateral.js"></script>

</body>
</html>

