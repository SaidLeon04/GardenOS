<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">    
        <link rel="stylesheet" type="text/css" href="barra_lateral.css">
        <link rel="stylesheet" href="estilos_boton_flotante.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
        <link rel="stylesheet" href="estilos_catalogo.css">
        <link rel="stylesheet" href="estilos_acciones_lote.css">        
    <title>Dashboard</title>
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
            Puedes actuar sobre tus lotes con:
        </header>
 
    </div>
    <?php 
        include("../conexion.php");
        $id_lote = $_GET['id_lote'];
        $nombre_lote = $_GET['nombre_lote'];
        $consulta_estado = "SELECT estado FROM historial WHERE id_lote = '$id_lote' GROUP BY estado DESC LIMIT 1";
        $resultado_estado = mysqli_query($conexion,$consulta_estado);
        while ($row = $resultado_estado ->fetch_array()) {
            $estado = $row['estado'];
        }
    ?>

<center>
<table>
  <tr>
    <td>

      <div class="card">
        <div class="card-img">
            <center> 
                <br>
                <br>
        <Img  src="./img/RIEGO.png"></Img> 
            </center>
        </div>
          <div class="card-info">
            <p class="text-title">Riego</p>
            <p class="text-body">
              Mide el agua gastada.
              Calcula el PH de agua.
              Registra y controla el riego.
            </p>
            <a href="../formularios/formulario_riego.php?id_lote=<?php echo $id_lote;?>&nombre_lote=<?php echo $nombre_lote ?>" title="El agua mantiene los procesos naturales de una planta"><button class="card-button">RIEGO</button></a>
          </div>
          
        </div>
  </td>

  <td>
    <div class="card">
      <div class="card-img">
        <center> 
                <br>
                <br>
              <img src="./img/TEMPERATURA.png">
        </center>
      </div>
        <div class="card-info">
          <p class="text-title">Temperatura</p>
          <p class="text-body">
            Registra los grados de la tierra
            Agenda la variación
            de temperaturas.
          </p>
          <a href="../formularios/formulario_temperatura.php?id_lote=<?php echo $id_lote;?>&nombre_lote=<?php echo $nombre_lote ?>" title="La Temperatura es vital para las condiciones habitables de una planta"><button class="card-button">TEMPERATURA</button></a>
        </div>
      </div>
  </td>

  <td>
    <div class="card">
      <div class="card-img">
        <center> 
                <br>
                <br>
                <Img  src="./img/HUMEDAD.png"></img>
        </center>
      </div>
        <div class="card-info">
          <p class="text-title">Humedad</p>
          <p class="text-body">
            Registra los grados
            de la tierra.
            Agenda la variación
            de temperaturas.
          </p>
        <a href="../formularios/formulario_humedad.php?id_lote=<?php echo $id_lote;?>&nombre_lote=<?php echo $nombre_lote ?>" title="Las raices deben de mantenerse humedas para mantener el habitat"><button class="card-button">HUMEDAD</button></a>
        </div>
      </div>
  </td>

  <td>
    <div class="card">
      <div class="card-img">
      <center> 
                <br>
                <br>
                <Img src="./img/ILUMINACION.png"></Img>
      </center>
      </div>
        <div class="card-info">
          <p class="text-title">Iluminación</p>
          <p class="text-body">
            Mide la iluminación.
            Registra cantidades.
            LLeva control de las medidas.
          </p>
        <a href="../formularios/formulario_iluminacion.php?id_lote=<?php echo $id_lote;?>&nombre_lote=<?php echo $nombre_lote ?>" title="La iluminación adecuada promueve la fotosintesis de las plantas"><button class="card-button">ILUMINACION</button></a>
        </div>
      </div>
  </td>
  <tr></tr>
<?php
  if($estado != 'germinacion'){

?>
  <td>
    <div class="card">
      <div class="card-img">
      <center> 
                <br>
                <br>
                <Img src="./img/CAMBIO DE TIERRA.png"></Img>
      </center>
      </div>
        <div class="card-info">
          <p class="text-title">Cambio de Tierra</p>
          <p class="text-body">
            Registra el tipo de tierra.
            Contrala las fechas de cambio.
          </p>
        <a href="../formularios/formulario_tierras.php?id_lote=<?php echo $id_lote;?>&nombre_lote=<?php echo $nombre_lote ?>" title="Cambiar parcialmente la tierra de una planta mejora su desarrollo"><button class="card-button">CAMBIO DE TIERRA</button></a>
        </div>
      </div>
  </td>
<?php } 
  if($estado != 'germinacion' && $estado != 'siembra'){

?>

  <td>
    <div class="card">
      <div class="card-img">
      <center> 
                <br>
                <br>
                <Img src="./img/PODA.png"></Img>
      </center>
      </div>
        <div class="card-info">
          <p class="text-title">Poda</p>
          <p class="text-body">Registra las fechas de poda</p>
        <a href="../formularios/formulario_poda.php?id_lote=<?php echo $id_lote;?>&nombre_lote=<?php echo $nombre_lote ?>" title="Algunas plantas requieren balancear sus hojas o ramas periodicamente"><button class="card-button">PODA</button></a>
        </div>
      </div>
  </td>
 <?php } ?>
  <td>
    <div class="card">
      <div class="card-img">
      <center> 
                <br>
                <br>
                <Img src="./img/AVANZA UN PASO.png"></Img>
      </center>
      </div>
        <div class="card-info">
          <p class="text-title">Avanzar un paso</p>
          <p class="text-body">
            Pasa de germinación a siembra
            De siembra a cosecha.
          </p>
        <a href="../formularios/formulario_avance.php?id_lote=<?php echo $id_lote;?>&nombre_lote=<?php echo $nombre_lote ?>" title="Pasa al siguiente paso..."><button class="card-button">AVANZA UN PASO</button></a>
        </div>
      </div>
  </td>
</center>
</table>
</section>
</body>
<script src="script_barra_lateral.js"></script>
</html>