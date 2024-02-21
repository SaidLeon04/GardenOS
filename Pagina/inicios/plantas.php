<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="barra_lateral.css">
        <link rel="stylesheet" href="estilos_boton_mas.css">
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
    .scroll{
        height:50px;
        width:350px;
        scroll-snap-type: y mandatory;        
        overflow: auto;
        border-radius: 10px;

    }

    ::-webkit-scrollbar{
        width: 5px;
    }
    ::-webkit-scrollbar-track{
        background:  white;
    }
    ::-webkit-scrollbar-thumb{
        background: #695CFE;
        border-radius: .5rem;
    }
    </style>
</head>
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
<body bgcolor="#F6F5FF">
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

            Catalogo de plantas
            <?php 
                echo "de:<strong> ". $_SESSION['nombre']."</strong>"; 
            ?>

        </header>
            <a href="../formularios/formulario_plantas.php">
            <button class="btn_mas">+</button>
        </a> 


    </div>
        <?php
            include("../conexion.php");

            $query = "SELECT * FROM plantas WHERE id_usuario = $id_usuario";
            $resultado = mysqli_query($conexion,$query);
       ?>
    <center>
        <div>
        <?php
            while ($row = $resultado->fetch_array()) {
                echo '<table border="2px">';
                        echo '<tr><td colspan = "3"><img src="'.$row['imagen'].'" alt="La imagen te persigue, pero tu eres mas rápido" width="350px" height="200px"></td></tr>';
                        echo '<tr class 
                        
                        = "datos"><td colspan = "3"><h5>' . $row["tipo"] . '</h5>';
                        echo '<h3>' . $row["nombre"] .'</h3></td></tr>';
                        echo '<tr class = "descripcion"><td colspan = "3"><div class="scroll">' . $row["descripcion"] . '</tr></td>';
                        echo '<tr class = "links">
                                <td>
                                    <a href="../formularios/formulario_lote.php?
                                        nombre_planta='.$row["nombre"].'
                                        &id_planta='.$row["id_planta"].'">
                                            Crear lote
                                    </a>
                                </td>';
                        echo '
                                <td>

                                <a href="borrar_planta.php?id_planta='.$row['id_planta'].'">
                                        Borrar Planta
                                </a>
                                </td>
                            ';
                        
                        echo '<td colspan = "2"><a href="modificar_planta.php?id_planta='.$row['id_planta'].'&nombre='.$row['nombre'].'&descripcion='.$row['descripcion'].'&imagen='.$row['imagen'].'">Modificar Información</a></tr></td>';
                        
                echo '</table>';
                echo '<br>';  
            }
        ?>
        </div>
    </center>
</section>
<script src="script_barra_lateral.js"></script>
</body>
</html>

