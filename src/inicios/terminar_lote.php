<?php
			$borrar_lote = "UPDATE lote SET estado='finalizado' WHERE id_lote = '$id_lote'";
			$resultado_borrar_lote = mysqli_query($conexion,$borrar_lote);
			if($resultado_borrar_lote){
				echo "si";
				header("Location: lotes_terminados.php");
			}

?>