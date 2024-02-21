<?php
	include ("../conexion.php");
if(isset($_POST['eliminar'])){
	$id_plaga = $_POST['id_plaga'];
    $nombre_plaga = $_POST['nombre_plaga'];
    $validez_nombre = FALSE;

    $consulta_nombre_plaga = "SELECT nombre_plaga FROM plagas WHERE nombre_plaga = '$nombre_plaga'";
    $resultado_nombre_plaga = mysqli_query($conexion, $consulta_nombre_plaga); 
    while ($row = $resultado_nombre_plaga -> fetch_array()){
        $row['nombre'];
        $validez_nombre = TRUE;
        }
    if($validez_nombre){

	$consulta = "DELETE FROM plagas WHERE id_plaga = '$id_plaga'";
	$resultado = mysqli_query($conexion,$consulta);

	if ($resultado) {
                header("Location: ../inicios/plagas.php");
            }else{
                echo "error";
            }
    }else{
    	echo "La plaga con el nombre ".$nombre_plaga. " no existe";
    }
}
?>