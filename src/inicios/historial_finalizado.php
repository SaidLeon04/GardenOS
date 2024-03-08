<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" type="text/css" href="barra_lateral.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
        <link rel="stylesheet" href="estilos_catalogo.css">
        <link rel="stylesheet" type="text/css" href="time_line.css">
    <title>Dashboard</title>
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
        <?php 
            $id_lote = $_GET['id_lote'];
            $nombre_lote = $_GET['nombre_lote'];
        ?>
        <header>
            Historial del lote: <?php echo $nombre_lote ?>
        </header> 
    </div>
    <div class="page">
        <div class="timeline">

    <?php
            $consulta = "SELECT * FROM historial WHERE id_lote = '$id_lote' AND estado != 'finalizado' ";
            $resultado = mysqli_query($conexion,$consulta);

            while ($row = $resultado->fetch_array()) {


            
    ?>
            <div class="timeline__group">
                <h1><?php  
                $cantidad_inicial = $row['cantidad'];
                echo $estado = $row['estado'];  
                        if ($estado == 'germinacion') {
                            $estado_ciclo = 'siembra';
                        }elseif ($estado == 'siembra') {
                            $estado_ciclo = 'crecimiento';
                        }elseif ($estado == 'crecimiento') {
                            $estado_ciclo = 'cosecha';
                        }

                        ?></h1>
                <span class="timeline__year time" aria-hidden="true">
                    <?php echo "Fecha: ".$row['fecha']."<br>Cantidad Inicial: ".$row['cantidad'];?></span>
      <div class="timeline__cards">
        <div class="timeline__card card">
          <header class="card__header">
            <time class="time" datetime="2008-02-02">
              <span class="time__day">Promedio de actividades del <?php     
            $consulta_fecha1 = "SELECT fecha FROM historial WHERE id_lote = '$id_lote' AND estado = '$estado'";
            $resultado_fecha1 = mysqli_query($conexion,$consulta_fecha1);

            while ($row = $resultado_fecha1->fetch_array()) {
                $fecha1 = new DATETIME ($row['fecha']);
                $fecha1 = $fecha1->format('Y-m-d');
            }
            $consulta_fecha2 = "SELECT fecha, cantidad FROM historial WHERE id_lote = '$id_lote' AND estado = '$estado_ciclo'";
            $resultado_fecha2 = mysqli_query($conexion,$consulta_fecha2);

            while ($row = $resultado_fecha2->fetch_array()) {
                $fecha2 = new DATETIME ($row['fecha']);     
                $fecha2 = $fecha2->format('Y-m-d');
            }
            echo "<h3 class='card__title r-title'>".$fecha1 ." - ". $fecha2."</h3>";
            echo "<a href='actividad_lote.php?id_lote=".$id_lote."&nombre_lote=".$nombre_lote."'>Ver Actividades directamente</a>"

?>
        
    </span>
              <span class="time__month"></span>
            </time>
          </header>
          <div class="card__content">
            <p><?php
                include("promedios.php");
                echo "Minutos de riego = ".$duracion."<br>";
                if ($contador != 0) {
                    echo "PH Promedio =".round($ph_promedio = $ph/$contador, 2).'<br>';
                }
                echo "Agua gastada =".$agua."<br>";

                echo "Temperatura promedio = ".$temperatura_promedio."<br>";

                echo "Humedad promedio = ".round($humedad_promedio,2)."<br>";

                echo "Luxes Promedio = ".round($promedio_iluminacion,4)."<br>";
                echo "Situacion mas medida = ".$situacion_promedio."<br>";

                echo "Tierra usada en cambios = ".round($promedio_cambio_tierra, 2)."KG <br>";
                #echo "Textura mas usada = ".$textura_promedio."<br>";
               # echo "Iluminación mas frecuente = ".$iluminacion_frecuencia."<br>"; 
                echo "Podas realizadas = ".$contador_poda_num.'<br>';
                if($estado == 'crecimiento'){
                    echo "Crecimiento promedio = ".$promedio_crecimiento .' cm';
                }
?>


            </p>
          </div>
        </div>
        <div class="timeline__card card">
          <header class="card__header">
            <time class="time" datetime="2008-02-02">Perdidas & Eficacia
              <span class="time__day"></span>
              <span class="time__month"></span>
            </time>
            <h3 class="card__title r-title">Perdida de Semillas</h3>
          </header>
          <div class="card__content">
            <p>
            <?php
                include("perdidas.php");

                echo "<p style='color: blue ;'>Dias Transcurridos: ".$diff->days."</p>";

                $perdida_semillas = $cantidad1 - $cantidad2;
                $porcentaje_restante = (($cantidad2*100)/$cantidad1);
                $semillas_restantes = $cantidad_inicial - $perdida_semillas;
                $porcentaje_perdida = 100 - $porcentaje_restante;

                echo "<p style='color: red ;'>Semillas perdidas: ".$perdida_semillas."</p><br>";
                echo "<p style='color: red ;'>Porcentaje de perdida: ".round($porcentaje_perdida,2)
                ."%</p><br>";

                echo "<p style='color: green ;'>Semillas restantes ciclo: ".$semillas_restantes."</p>";
                echo "<p style='color: green ;'>Eficiencia de ciclo: ".round($porcentaje_restante,2)."%</p>";
            ?>
            </p>
          </div>
        </div>
      </div>
    </div>

<?php }  ?>


  </div>
</div>



    </center>
</section>
</body>
<script src="script_barra_lateral.js"></script>
</html>