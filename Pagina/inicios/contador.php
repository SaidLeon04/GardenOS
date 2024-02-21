<?php           

            $consulta_count = "SELECT COUNT(estado) AS numero FROM historial WHERE id_lote = '$id_lote'";
            $resultado_consulta_count = mysqli_query($conexion,$consulta_count);
            while ($row = $resultado_consulta_count -> fetch_array()) {
                $numero = $row['numero'];

           
                        }

?>