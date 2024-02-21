<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
    function eliminarPlanta() {
    var respuesta = confirm("¿Eliminar Planta?, Esta accion no puede reslizarse si a planta existe en un lote ¿continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}
</script>
    <title>HUMEDAD</title>
    <body bgcolor="#ABB2B9">
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
            background-image: linear-gradient(to bottom, #808B96, #EAECEE);
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
            color: #17202A;
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
            background-image: linear-gradient(to right, #808B96, #000000);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-image: linear-gradient(to right, #000000, #808B96);
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

<div class="container">
    <h1>Eliminar</h1>
    <form action="borrar_planta_action.php" method="POST">
        <?php 
            include("../conexion.php");
            $id_planta = $_GET['id_planta'];
        ?>
        <input type="number" name="id_planta" readonly value="<?php echo $id_planta?>" hidden>
        <input type="text" name="nombre_planta" placeholder="Nombre de la planta">
        <label>Esta acción eliminar definitivamente una planta.</label><br><br>
        <label>No puedes realizar esta acción si la planta existe en un lote</label><br><br>
        <input type="submit" name="eliminar" value="Eliminar" onclick="return eliminarPlanta()">
    </form>
</div>
</body>
<script src="../inicios/script_barra_lateral.js"></script>
</html>
