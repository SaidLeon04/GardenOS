<!DOCTYPE html>
<html>
<head>
    <title>Plantas</title>
    <body bgcolor="#A9DFBF">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="barra_lateral.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
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
            background-image: linear-gradient(to bottom, #7DCEA0, #E9F7EF);
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
            color: #2f5f18;
            transform: scale(1.05);
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"],
        input[type="button"],
        input[type="file"],
        select,
        textarea {
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
        input[type="password"]:focus,
        input[type="button"]:focus,
        input[type="submit"]:focus,
        input[type="file"]:focus,
        select:focus,
        textarea:focus {
            background-color: rgb(200, 243, 214);
            outline: none;
            transform: scale(1.05);
        }

        input[type="submit"] {
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-image: linear-gradient(to right, #7DCEA0, #000000);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-image: linear-gradient(to right, #000000, #7DCEA0);
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
    <h1>PLAGAS</h1>
    <form action="avistamiento_plaga_action.php" method="POST" enctype="multipart/form-data">
        <?php
            $id_plaga = $_GET['id_plaga'];
            $nombre = $_GET['nombre'];
            $tratamiento = $_GET['tratamiento'];
            $afectaciones = $_GET['afectaciones'];
            $causas = $_GET['causas'];
            $consulta = "SELECT * FROM lote JOIN plantas ON lote.id_planta = plantas.id_planta WHERE id_usuario = '$id_usuario' AND estado != 'finalizado'";
            $resultado = mysqli_query($conexion,$consulta);
        ?>
        <input type="text" name="id_plaga" hidden readonly value="<?php echo $id_plaga ?>">
        <input type="text" placeholder="Nombre plaga" readonly name="nombre" value="<?php echo $nombre ?>">
                <label>Lote detectado</label> <select name="id_lote">
        <?php
            while ($row = $resultado->fetch_array()) {
                echo '<option value="'.$row['id_lote'].'">'.$row['nombre_lote'].'</option>';
            }
        ?>
        </select>
            <input type="text" placeholder="Tratamiento" hidden name="tratamiento" value="<?php echo $tratamiento ?>">
            <input type="text" placeholder="Afectaciones" hidden name="afectaciones" value="<?php echo $afectaciones ?>">
            <input type="text" placeholder="Causas" hidden name="causas" value="<?php echo $causas ?>">
            <input type="submit" value="Guardar" name="guardar">
    </form>
</div>
</section>
</body>
<script src="../inicios/script_barra_lateral.js"></script>
</html>

