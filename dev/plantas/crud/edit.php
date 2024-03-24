<?php
include("../../conexion.php");
include("../../statements.php");

# TODO validar tipo de imagenes y tal vez tamaño
$id_planta = $_POST['id_planta'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$descripcion = $_POST['descripcion'];
$temporal_imagen = $_FILES['imagen']['tmp_name'];
$image = base64_encode(file_get_contents(addslashes($temporal_imagen)));
$existe = false;

    $stmt = $conexion->prepare($consulta_planta);
    $stmt->bind_param("i", $id_planta);
    $stmt->execute();
    $stmt->store_result(); 

    if ($stmt->num_rows > 0){
        $existe = true;
    }else{
        echo "La planta no existe";
    }

    # TODO actualizar todo? o solo los campos que se quieren cambiar?
    if($existe){
        $stmt = $conexion->prepare("UPDATE plantas SET nombre = ?, tipo = ?, descripcion = ?, imagen = ? WHERE id_planta = ?");
        $stmt->bind_param("ssssi", $nombre, $tipo, $descripcion, $image, $id_planta);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: ../plantas.php");
        } else {
            echo "No se realizaron cambios.";
        }
    }

$stmt->close();
$conexion->close();
?>