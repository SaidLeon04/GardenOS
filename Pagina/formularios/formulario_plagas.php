<!DOCTYPE html>
<html>
<head>
    <title>PLAGAS</title>
    <body bgcolor="#D7BDE2">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../inicios/estilos_barra_lateral.css">
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
            background-image: linear-gradient(to bottom, #C39BD3, #F5EEF8);
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
            color: #512E5F;
            transform: scale(1.05);
        }

        input[type="text"],
        input[type="submit"],
        input[type="file"],
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
        input[type="submit"]:focus,
        input[type="filo"]:focus,
        select:focus {
            background-color: #EBDEF0;
            outline: none;
            transform: scale(1.05);
        }

        input[type="submit"] {
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-image: linear-gradient(to right, #C39BD3, #000000);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-image: linear-gradient(to right, #000000, #C39BD3);
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
<?php
    $consulta = "SELECT nombre_lote, id_lote FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta  WHERE id_usuario = '$id_usuario' GROUP BY nombre_lote";
    $resultado = mysqli_query($conexion,$consulta);
?>
<div class="container">
    <h1>PLAGAS</h1>
    <form action="formulario_plagas_action.php" method="POST" enctype="multipart/form-data">
        <input type="text" placeholder="Nombre plaga" name="nombre">
        <label>Lote detectado</label> <select name="id_lote">
        <?php
            while ($row = $resultado->fetch_array()) {
                echo '<option value="'.$row['id_lote'].'">'.$row['nombre_lote'].'</option>';
            }
        ?>
        </select>
            <input type="text" placeholder="Tratamiento" name="tratamiento">
            <input type="text" placeholder="Afectaciones" name="afectaciones">
            <input type="text" placeholder="Causas" name="causas">
        <select name="peligro">
            <option>Peligro</option>
            <option>Bajo</option>
            <option>Medio</option> 
            <option>Alto</option>           
        </select>
            <input type="file" name="imagen">
            <input type="submit" value="Guardar" name="guardar">
    </form>
</div>
</body>
<script src="../inicios/script_barra_lateral.js"></script>
</html>
 