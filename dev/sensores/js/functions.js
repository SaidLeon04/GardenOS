function eliminarSensor() {
    var respuesta = confirm("¿Eliminar Sensor?, El sensor y su URL de conexión seran eliminados ¿continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}

function editarSensor() {
    var respuesta = confirm("¿Editar uso del sensor?, A partir de ahora se asociara al sensor al lote seleccionado ¿continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }   
}

function desvincularSensor() {
    var respuesta = confirm("¿Desvincular Sensor?, Use esta acción solo si va a cambiar el sensor a otro lote. ¿continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}

function editActive(formularioId) {
    alert("Edición activada")
    const formulario = document.getElementById(formularioId);
    if (formulario) {
        const parrafos = formulario.querySelectorAll('.parrafo');
        const btn_vincular = document.getElementById('btn-vincular');
        const btn_delete = document.getElementById('btn-delete');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_cancel = document.getElementById('btn-cancel');
        const nombre_sensor = document.getElementById('nombre_sensor');
        const select_lote = document.getElementById('select_lote');
        const select_tipo = document.getElementById('select_tipo');
        const url = document.getElementById('url');

        
        parrafos.forEach(p => {
            p.setAttribute('hidden', true);
        });
        btn_vincular.setAttribute('hidden', true);
        btn_delete.setAttribute('hidden', true);

        nombre_sensor.removeAttribute('hidden');
        select_lote.removeAttribute('hidden');
        select_tipo.removeAttribute('hidden');
        url.removeAttribute('hidden');
        btn_guardar.removeAttribute('hidden');
        btn_cancel.removeAttribute('hidden');
    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}

function editInactive(formularioId) {
    alert("Edición desactivada")
    const formulario = document.getElementById(formularioId);
    if (formulario) {
        const parrafos = formulario.querySelectorAll('.parrafo');
        const btn_vincular = document.getElementById('btn-vincular');
        const btn_delete = document.getElementById('btn-delete');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_cancel = document.getElementById('btn-cancel');
        const nombre_sensor = document.getElementById('nombre_sensor');
        const select_lote = document.getElementById('select_lote');
        const select_tipo = document.getElementById('select_tipo');
        const url = document.getElementById('url');

        
        parrafos.forEach(p => {
            p.removeAttribute('hidden');
        });
        btn_vincular.removeAttribute('hidden');
        btn_delete.removeAttribute('hidden');

        nombre_sensor.setAttribute('hidden', true);
        select_lote.setAttribute('hidden', true);
        select_tipo.setAttribute('hidden', true);
        url.setAttribute('hidden', true);
        btn_guardar.setAttribute('hidden', true);
        btn_cancel.setAttribute('hidden', true);
    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}


