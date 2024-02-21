<!DOCTYPE html>
<html>
<head>
    <title>CRECIEMIENTO</title>
    <body bgcolor="#E6B0AA">
    <meta charset="UTF-8">
    <style>

        .container {
            max-width: 300px;
            margin: 100px auto;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
            animation: fade 1s;
            background-image: linear-gradient(to bottom, #D98880, #F9EBEA);
        }

        .container:hover {
            transform: translateY(-5px);
        }

        @keyframes fade {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        h1 {
            color: #000000;
            font-size: 32px;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }

        h1:hover {
            color: #641E16;
            transform: scale(1.05);
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="submit"]:focus,
        select {
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus,
        input[type="submit"]:focus,
        select:focus {
            background-color: #F2D7D5;
            outline: none;
            transform: scale(1.05);
        }

        input[type="submit"]{
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-image: linear-gradient(to right, #D98880, #000000);
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-image: linear-gradient(to right, #000000, #D98880);
            animation: pulse 1s infinite;
            transform: scale(1.05);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>CRECIEMIENTO</h1>

    <form action="formulario_crecimiento_action.php" method="POST">
            <?php
                include("../conexion.php");
                $id_lote = $_GET['id_lote'];
                $nombre_lote = $_GET['nombre_lote'];

                $consulta_fecha_ultima = "SELECT * FROM historial WHERE id_lote = '$id_lote' AND estado='crecimiento'";
                $resultado_consulta_fecha_ultima = mysqli_query($conexion,$consulta_fecha_ultima);
                while ($row = $resultado_consulta_fecha_ultima -> fetch_array()) {
                    $ultima_fecha = $row['fecha'];
                    $cantidad_estado = $row['cantidad'];
                    $porcentaje =  round($cantidad_estado * 0.10 );
                }
                $consulta_fecha = "SELECT fecha FROM crecimiento WHERE id_lote = '2' GROUP BY id_crecimiento DESC LIMIT 1";
                $resultado_consulta_fecha = mysqli_query($conexion, $consulta_fecha);
                while($row = $resultado_consulta_fecha -> fetch_array()){
                    $fecha_final = $row['fecha'];
                }

            ?>
        <p>Mide el crecimiento del 10% de tu lote: <?php echo $porcentaje.' plantas'?>  </p>
        <input type="text" name="id_lote" value="<?php echo $id_lote?>" readonly hidden>            
        <input type="text" name="nombre_lote" value="<?php echo $nombre_lote?>" readonly>

        <input type="date" placeholder="Fecha" min="<?php echo $fecha_final?>" max="2100-12-12" name="fecha">
        <input type="number" placeholder="Suma de <?php echo $porcentaje?>  Medidas" name="medidas" min="1">
        <input type="number" readonly value="<?php echo $porcentaje?>" name="divisor" hidden >
        <select name="unidad">
            <option value="mm">MM</option>
            <option value="cm">CM</option> 
            <option value="m">M</option> 
        </select>
        <input type="submit" name="guardar" value="Guardar">
        <?php
        echo '<a href="formulario_cosecha.php?id_usuario='.$id_usuario.'&id_lote='.$id_lote.'&nombre_lote='.$nombre_lote.'">Avanzar a cosecha</a>'
        ?>
    </form>
</div>
</body>
</html>
