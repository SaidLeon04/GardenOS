<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">    
        <link rel="stylesheet" type="text/css" href="barra_lateral.css">
        <link rel="stylesheet" type="text/css" href="btn_eliminar">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>

        <style type="text/css">
            table{
                border: 0;
                color: white;
                text-align:center;
            }
            th{                
                background-color:#707070;
                border-radius: 12px;
            }
            td{
                color: black;
                background-color:#daeef5;
            }
            td:hover{
                background-color: #695CFE;
                color: white;
                transition:all 0.7s ease;
            }
            button{
                background-color: #F6F5FF;
                color: black;
                border-radius: 6px;
                border-color:#F6F5FF;

            }
            button:hover{
                background-color: red;
                border-color: red;
                transition:all 0.7s ease;
            }
        </style>

        <script type="text/javascript">
            function borrarRegistro() {
                var respuesta = confirm("¿Eliminar Registro?, Esto alterara los registros y promedios ¿continuar?");
                if (respuesta == true) {
                    return true;
                }else{
                    return false;
                }
            }   
        </script>
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
            	<?php 
            		include ("../conexion.php");
					$id_lote = $_GET['id_lote'];
					$nombre_lote = $_GET['nombre_lote'];

					echo "<h1>Lote:$nombre_lote</h1>";
            	 ?>
            </header>
        </div>
    <div style="display:flex; justify-content: center; align-items: center;">
    <center>
<?php
            echo '<table>';
                echo '<th colspan="6">Riegos';        
                    /*<select> 
                        <option>Filtra por:</option>
                        <option>duración ascendente</option>
                        <option>duración descendente</option>
                        <option>cantidad de agua ascendente</option>
                        <option>cantidad de agua descendente</option>
                    </select>*/
            echo '</th><tbody><tr>';
            echo '<td>Fecha</td>';
            echo '<td>Hora</td>';
            echo '<td>Duracion</td>';
            echo '<td>Cantidad de Agua</td>';
            echo '<td>PH Agua</td>';
            echo '<td>Eliminar</td>';
            echo "</tr><tr>";
	$consulta_riego = "SELECT * FROM riego WHERE id_lote = '$id_lote'";
	$resultado_riego = mysqli_query($conexion, $consulta_riego);
		while ($row = $resultado_riego->fetch_array()) {
            
			echo '<td>'. $row['fecha'].'</td>';
			echo '<td>'. $row['hora'].'</td>';
			echo '<td>'. $row['duracion'].' minutos</td>';
			echo '<td>'. $row['cantidad_agua'].' Litros</td>';
			echo '<td>'. $row['ph_agua'].'</td>';
            echo '<td><a  href="eliminaciones/borrar_registro.php?id_riego='.$row['id_riego'].'&actividad=riego"><button onclick="return borrarRegistro()" class="btn">Eliminar<button></a></td></tr></tbody>';
        }
            echo '</table><br><br>';


            echo '<table>';
            echo '<th colspan="4">Temperatura</th><tr>';
            echo '<td>Fecha</td>';
            echo '<td>Hora</td>';
            echo '<td>Temperatura</td>';
            echo '<td>Eliminar</td>';
            echo "</tr><tr>";
	$consulta_temperatura = "SELECT * FROM temperatura WHERE id_lote = '$id_lote'";
	$resultado_temperatura = mysqli_query($conexion, $consulta_temperatura);
		while ($row = $resultado_temperatura->fetch_array()) {
			echo '<td>'. $row['fecha'].'</td>';
			echo '<td>'. $row['hora'].'</td>';
			echo '<td>'. $row['temperatura'].'</td>';
            echo '<td><a href="eliminaciones/borrar_registro.php?id_temperatura='.$row['id_temperatura'].'&actividad=temperatura"><button onclick="return borrarRegistro()">Eliminar<button></a></td></tr>';
        }
            echo '</table><br><br>';

            echo '<table>';
            echo '<th colspan="5">Humedad</th><tr>';
            echo '<td>Fecha</td>';
            echo '<td>Hora</td>';
            echo '<td>Humedad</td>';
            echo '<td>Eliminar</td>';
            echo "</tr><tr>";
    $consulta_humedad = "SELECT * FROM humedad WHERE id_lote = '$id_lote'";
	$resultado_humedad = mysqli_query($conexion, $consulta_humedad);
		while ($row = $resultado_humedad->fetch_array()) {
			echo '<td>'. $row['fecha'].'</td>';
			echo '<td>'. $row['hora'].'</td>';
			echo '<td>'. $row['humedad'].'</td>';
            echo '<td><a href="eliminaciones/borrar_registro.php?id_humedad='.$row['id_humedad'].'&actividad=humedad"><button onclick="return borrarRegistro()">Eliminar<button></a></td></tr>';
        }
            echo '</table><br><br>';


            echo '<table>';
            echo '<th colspan="5">Iluminacion</th><tr>';
            echo '<td>Fecha</td>';
            echo '<td>Hora</td>';
            echo '<td>Situación</td>';
            echo '<td>Iluminación</td>';
            echo '<td>Eliminar</td>';
            echo "</tr><tr>";
    $consulta_iluminacion = "SELECT * FROM iluminacion WHERE id_lote = '$id_lote'";
	$resultado_iluminacion = mysqli_query($conexion, $consulta_iluminacion);
		while ($row = $resultado_iluminacion->fetch_array()) {

			echo '<td>'. $row['fecha'].'</td>';
			echo '<td>'. $row['hora'].'</td>';
			echo '<td>'.$row['situacion'].'</td>';
			echo '<td>'. $row['iluminacion'].'</td>';
            echo '<td><a href="eliminaciones/borrar_registro.php?id_iluminacion='.$row['id_iluminacion'].'&actividad=iluminacion
            "><button onclick="return borrarRegistro()">Eliminar<button></a></td></tr>';
        }
            echo '</table><br><br>';

            echo '<table>';
            echo '<th colspan="5">Cambio de Tierras</th><tr>';
            echo '<td>Fecha</td>';
            echo '<td>Textura</td>';
            echo '<td>Cantidad</td>';
            echo '<td>Eliminar</td>';
            echo "</tr><tr>";
    $consulta_cambio_tierra = "SELECT * FROM cambio_tierra WHERE id_lote = '$id_lote'";
	$resultado_cambio_tierra = mysqli_query($conexion, $consulta_cambio_tierra);
		while ($row = $resultado_cambio_tierra->fetch_array()) {
			echo '<td>'. $row['fecha'].'</td>';
			echo '<td>'. $row['textura'].'</td>';
			echo '<td>'.$row['cantidad_tierra'].'</td>';
            echo '<td><a href="eliminaciones/borrar_registro.php?id_cambio_tierra='.$row['id_tierra'].'&actividad=cambio_tierra"><button onclick="return borrarRegistro()">Eliminar<button></a></td></tr>';
        }
            echo '</table><br><br>';


            echo '<table>';
            echo '<th colspan="5">Poda</th><tr>';
            echo '<td>Fecha</td>';
            echo '<td>Eliminar</td>';
            echo "</tr><tr>";
    $consulta_poda = "SELECT * FROM poda WHERE id_lote = '$id_lote'";
	$resultado_poda = mysqli_query($conexion, $consulta_poda);
		while ($row = $resultado_poda->fetch_array()) {
			echo '<td>'. $row['fecha'].'</td>';
            echo '<td><a href="eliminaciones/borrar_registro.php?id_poda='.$row['id_poda'].'&actividad=poda"><button onclick="return borrarRegistro()">Eliminar<button></a></td></tr>';
        }
            echo '</table><br><br>';

            echo '<table>';
            echo '<th colspan="5">Crecimiento</th><tr>';
            echo '<td>Fecha</td>';
            echo '<td>Medida Promedio(cm)</td>';
            echo '<td>Eliminar</td>';            
            echo "</tr><tr>";
    $consulta_crecimiento = "SELECT * FROM crecimiento WHERE id_lote = '$id_lote'";
    $resultado_crecimiento = mysqli_query($conexion, $consulta_crecimiento);
        while ($row = $resultado_crecimiento->fetch_array()) {
            echo '<td>'. $row['fecha'].'</td>';
            echo '<td>'. $row['medida'].'</td>';
            echo '<td><a href="eliminaciones/borrar_registro.php?id_crecimiento='.$row['id_crecimiento'].'&actividad=crecimiento"><button onclick="return borrarRegistro()">Eliminar<button></a></td></tr>';
        }
            echo '</table><br><br>';
?>
    </center>
    </div>
    </section>
</body>
<script src="script_barra_lateral.js"></script>
</html>

