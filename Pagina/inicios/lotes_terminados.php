
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" type="text/css" href="barra_lateral.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
        <link rel="stylesheet" href="estilos_catalogo.css">
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
            Lotes terminados de: <?php echo "<strong> ". $_SESSION['nombre']."</strong>";?>
        </header> 
    </div>
        <?php
            $consulta = "SELECT * FROM plantas JOIN lotes_terminados ON plantas.id_planta = lotes_terminados.id_planta  WHERE plantas.id_usuario = '$id_usuario'";
            $resultado = mysqli_query($conexion,$consulta);
        ?>
    <center>
        <div>
        <?php
            while ($row = $resultado->fetch_array()) {
                $nombre = $row['nombre'];
                $tipo = $row['tipo'];
                $descripcion = $row['descripcion'];
                $imagen = $row['imagen'];
                $nombre_lote = $row['nombre_lote'];
                $fecha_inicial = $row['fecha_inicial'];
                $fecha_final = $row['fecha_final'];
                $cantidad_inicial = $row['cantidad_inicial'];
                $cantidad_final = $row['cantidad_final'];
                $eficacia = round($row['eficacia']);


                $fecha_inicial_dt = new DATETIME ($row['fecha_inicial']);
                $fecha_final_dt = new DATETIME ($row['fecha_final']);
                $diff = $fecha_inicial_dt->diff($fecha_final_dt);
                $dias = $diff->days;

                echo '<table border = "2px">';
                        echo '<tr><td colspan="5"><img src="'.$imagen.'" width="350px" height="200px"></td></tr>';
                        echo '<tr class = "datos"><td colspan="5"><h5>'.$nombre.' </h5>';
                        echo '<h5>'. $fecha_inicial.' al '.$fecha_final.'<br>'.$dias.' dias</h5>';  
                        echo '<h1>'. $nombre_lote.'</h1></td></tr>';
                        echo '<tr class = "descripcion"><td colspan="5" style="color: red;"> F I N A L I Z A D O</tr></td>';
                        echo '<tr class = "descripcion"><td colspan="5">De: ' . $cantidad_inicial . ' semillas a '.$cantidad_final.' semillas</tr></td>';
                        echo '<tr class = "descripcion"><td colspan="5">Eficacia de: '. $eficacia.'%</tr></td>';
                        echo '<tr colspan="5" class = "links"><td><a href="borrar_lote_terminado.php?id_lote='.$row['id_lote'].'">Borrar Lote</a></td>';                      
                        echo '<td><a href="actividad_lote.php?id_lote='.$row['id_lote'].'&nombre_lote='.$row['nombre_lote'].'">Actividad</a></td>';
                       echo '<td><a href="historial_finalizado.php?id_lote='.$row['id_lote'].'&nombre_lote='.$row['nombre_lote'].'">Historial</a></td></tr>';
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

?>