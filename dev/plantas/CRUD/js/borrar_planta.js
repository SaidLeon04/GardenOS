function eliminarPlanta() {
    var respuesta = confirm("¿Eliminar Planta?, Esta accion no puede reslizarse si a planta existe en un lote ¿continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}