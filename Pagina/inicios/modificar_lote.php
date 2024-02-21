<!DOCTYPE html>
<html>
<head>
    <title>LOTE</title>
    <body bgcolor="#BFC9CA">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="barra_lateral.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" type="text/css" href="estilos_boton_mas.css">
    <link rel="stylesheet" type="text/css" href="estilos_div.css">
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
            background-image: linear-gradient(to bottom, #AAB7B8, #F4F6F6);
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
            color: #4D5656;
            transform: scale(1.05);
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
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
        input[type="time"]:focus,
        input[type="number"]:focus,
        input[type="submit"]:focus,
        select:focus {
            background-color: #D5D8DC;
            outline: none;
            transform: scale(1.05);
        }

        input[type="submit"]{
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-image: linear-gradient(to right, #AAB7B8, #000000);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-image: linear-gradient(to right, #000000, #AAB7B8);
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
                        <a href="home.php" title="Volver al inicio">
                            <span class="material-symbols-outlined icon">
                                home
                            </span>
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="plantas.php" title="Ver catálogo de tus plantas">
                            <span class="material-symbols-outlined icon">
                                potted_plant
                            </span>
                            <span class="text nav-text">Plantas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="lotes.php">
                            <span class="material-symbols-outlined icon">
                                ballot
                            </span>
                            <span class="text nav-text">Lotes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="lotes_terminados.php">
                            <span class="material-symbols-outlined icon" style="color: blue;">
                                ballot
                            </span>
                            <span class="text nav-text">Lotes Terminados</span>
                        </a>
                    </li>    

                    <li class="nav-link">
                        <a href="plagas.php">
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
                    <a href="logout.php">
                        <span class="material-symbols-outlined icon">
                            logout
                            </span>
                        <span class="text nav-text">Salir</span>
                    </a>
                </li>

            </div>
        </div>
</nav>
<section class="home">
                        
<div class="container">
    <h1>Modificar Lote</h1>

    <form action="modificar_lote_action.php" method="POST">
        <?php 
            include("../conexion.php");
            $id_lote = $_GET['id_lote'];
            $nombre_lote =  $_GET['nombre_lote'];
 
        ?>
        <input type="text" name="id_lote" value="<?php echo $id_lote?>" hidden>
        <input type="text" placeholder="Nombre lote" name="nombre_lote" value="<?php echo $nombre_lote?>">
        <input type="submit" name="actualizar" value="Actualizar">
    </form>
</div>
</section>
</body>
<script src="script_barra_lateral.js"></script>
</html>
 