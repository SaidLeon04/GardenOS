<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" type="text/css" href="barra_lateral.css">
    <link rel="stylesheet" type="text/css" href="estilos_boton_mas.css">
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
        background-color: #b7ebcd;
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
    .links_2{
        background-color: #f5f382;
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
    <div class="text">
        <header>
            Catalogo de plagas

        </header>
         <a href="../formularios/formulario_plagas.php" title="nueva plaga">
            <button class="btn_mas">+</button>
        </a> 
    </div>

        <?php
            include("../conexion.php");

            $query = "SELECT * FROM plagas JOIN lote ON plagas.id_lote = lote.id_lote JOIN plantas ON lote.id_planta = plantas.id_planta WHERE id_usuario = '$id_usuario' GROUP BY nombre_plaga";
            $resultado = mysqli_query($conexion,$query);
            

       ?>
    <center>
        <div>
        <?php
            while ($row = $resultado->fetch_array()) {
                echo '<table border="2px">';
                        echo '<tr><td colspan="3"><img src="'.$row['imagen_plaga'].'" alt="las imagenes te persiguen, pero tu eres mas rápido..." width="350px" height="200px"></td></tr>';
                        echo '<tr class="datos"><td colspan="3"><h5>Nombre</h5>';
                        echo '<h3>'. $row["nombre_plaga"] . '</h3></td></tr>';
                        echo '<tr class="datos"><td colspan="3"><h5>Tratamiento</h5>';
                        echo  $row["tratamiento"] . '</tr></td>';
                        echo '<tr class="datos"><td colspan="3"><h5>Afectaciones</h5>';
                        echo $row["afectaciones"] . '</tr></td>';
                        echo '<tr class="datos"><td colspan="3"><h5>Causas</h5>';
                        echo $row["causas"] . '</tr></td>';                        
                        echo '<tr style="color: white ; background-color:red;"><td colspan="3"><h5>Nivel de Peligro</h5>';
                        echo $row["peligro"] . '</tr></td>';

                        /*echo '<tr>

                                    <td class = "links_2" colspan="3">
                                        <a href="plagas_lotes.php">Registros por lotes</a>    
                                        <a href="plagas_plantas.php">Registros por Plantas</a>
                                    </td>
                                </tr>';*/

                        echo '<tr class = "links"><td><a href="modificar_plaga.php?id_plaga='.$row['id_plaga'].'&nombre_plaga='.$row['nombre_plaga'].'&tratamiento='.$row['tratamiento'].'&afectaciones='.$row['afectaciones'].'&causas='.$row['causas'].'">Modificar Información</a></td>';

                       echo '<td>

                                <a href="borrar_plaga.php?id_plaga='.$row['id_plaga'].'">
                                        Borrar Plaga
                                </a>
                                </td>';
                        
                        echo '<td colspan="2" align="center"><a href="avistamiento_plaga.php?id_plaga='.$row['id_plaga'].'&nombre='.$row['nombre_plaga'].'&tratamiento='.$row['tratamiento'].'&afectaciones='.$row['afectaciones'].'&causas='.$row['causas'].'">Avistamiento</tr></td>';
                echo '</table>';
                echo '<br>';
            }
            $resultado->free_result();
            $conexion->close();
        ?>
        </div>
        <a href="plagas_globales.php" title="Ir a explorar">
            <button class="btn_ask">?</button>
        </a> 
    </center>
</section>
</body>
<script src="script_barra_lateral.js"></script>
</html>