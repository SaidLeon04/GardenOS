<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <link rel="stylesheet" type="text/css" href="barra_lateral.css">   
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title>Dashboard</title>
    <style type="text/css">
    table{
        width: 150px;
        height: 300px;
        text-align: center;
        border-radius: 18px;
    }    
    td{
        border: 0px;
    }
    img{
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;

    }
    .descripcion{
        background-color: white;
    }
    .datos{
        color: black;
        background-color: white;
    }
    .links{
        background-color: #f7dc6f;
    }

    table:hover {
        transform: scale(1.15);
        box-shadow: 5px 5px 15px rgba(0 , 0 , 0 , 0.6 ) ;
        transition: 0.5s ease;
        cursor: pointer;
        margin: 30px;
    }
    h5{
        color: #695cfe;
    }
    </style>
</head>
<body>
<?php
    include("../conexion.php");
?>
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
    <div class="text">
        <header>
            Lotes de: <?php echo "<strong> ". $_SESSION['nombre']."</strong>";?>
        </header> 
    </div>
        <?php


            $consulta = "SELECT * FROM plantas JOIN lote ON plantas.id_planta = lote.id_planta  WHERE id_usuario = '$id_usuario' AND estado != 'finalizado' GROUP BY nombre_lote";
            $resultado = mysqli_query($conexion,$consulta);
        ?>
    <center>
        <div>
        <?php
            while ($row = $resultado->fetch_array()) {
                $id_usuario = $row['id_usuario'];
                $id_lote = $row['id_lote'];
                $nombre_lote = $row['nombre_lote'];
                echo '<table border = "2px">';
                        echo '<tr><td colspan="5"><img src="'.$row['imagen'].'" width="350px" height="200px"></td></tr>';
                        echo '<tr class = "datos"><td colspan="5"><h5>'.$row['nombre'].' </h5>';
                        echo '<h5>Fecha de registro: ' . $row["fecha"] . '</h5>';  
                        echo '<h1>'. $row["nombre_lote"].'</h1></td></tr>';
                        echo '<tr class = "descripcion"><td colspan="5">Estado actual: ' . $row["estado"] . '</tr></td>';
                        echo '<tr class = "descripcion"><td colspan="5">Cantidad actual: ' . $row["cantidad_variable"] . '</tr></td>';
                        echo '<tr colspan="5" class = "links"><td><a href="borrar_lote.php?id_lote='.$row['id_lote'].'">Borrar Lote</a></td>';
                        echo '<td><a href="modificar_lote.php?id_lote='.$row['id_lote'].'&nombre_lote='.$row['nombre_lote'].'">Cambiar Nombre</a></td>';                        
                        echo '<td><a href="acciones_lote.php?id_lote='.$row['id_lote'].'&nombre_lote='.$row['nombre_lote'].'">Acciones</a></td>';
                        echo '<td><a href="actividad_lote.php?id_lote='.$row['id_lote'].'&nombre_lote='.$row['nombre_lote'].'">Actividad</a></td>';
                        include("contador.php");
                        if($numero > 1){
                            echo '<td><a href="historial_re.php?id_usuario='.$id_usuario.'&id_lote='.$id_lote.'&nombre_lote='.$nombre_lote.'">Historial</a></td></tr>';
}
                echo '</table>'; ?>
            <br> 
            <?php             
            }
        ?>
        </div>
    </center>
</section>
</body>
<script src="script_barra_lateral.js"></script>
</html>