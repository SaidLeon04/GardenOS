function eliminarPlanta() {
    var respuesta = confirm("¿Eliminar Planta?, Esta accion no puede reslizarse si a planta existe en un lote ¿continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}

function editarPlanta() {
    var respuesta = confirm("¿Editar Planta?, Toda la informacion nueva se asociara a sus lotes ya creados ¿continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
    
}

let nombre = document.getElementById('nombre').value;
let tipo = document.getElementById('tipo').value;
let descripcion = document.getElementById('descripcion').value;
function editActive(formularioId) {
    alert("Edición activada")
    const formulario = document.getElementById(formularioId);
    if (formulario) {
        const inputs = formulario.querySelectorAll('input[type="text"]');
        const btn_crear = document.getElementById('btn-crear');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_edit = document.getElementById('btn-edit');
        const btn_delete = document.getElementById('btn-delete');
        const btn_cancel = document.getElementById('btn-cancel');
        const label_imagen = document.getElementById('label-imagen');
        const input_imagen = document.getElementById('input-imagen');
        
        inputs.forEach(input => {
            input.removeAttribute('readonly');
        });
        btn_crear.setAttribute('hidden', true);
        btn_guardar.removeAttribute('hidden');
        btn_edit.setAttribute('hidden', true);
        btn_delete.setAttribute('hidden', true);
        btn_cancel.removeAttribute('hidden');
        label_imagen.removeAttribute('hidden');
        input_imagen.removeAttribute('hidden');

    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}

function editInactive(formularioId) {
    alert("Edición desactivada")
    const formulario = document.getElementById(formularioId);
    if (formulario) {
        const inputs = formulario.querySelectorAll('input[type="text"]');
        const btn_crear = document.getElementById('btn-crear');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_edit = document.getElementById('btn-edit');
        const btn_delete = document.getElementById('btn-delete');
        const btn_cancel = document.getElementById('btn-cancel');
        const label_imagen = document.getElementById('label-imagen');
        const input_imagen = document.getElementById('input-imagen');

        
        inputs.forEach(input => {
            input.setAttribute('readonly', true);
        });
        btn_crear.removeAttribute('hidden');
        btn_guardar.setAttribute('hidden', true);
        btn_edit.removeAttribute('hidden');
        btn_delete.removeAttribute('hidden');
        btn_cancel.setAttribute('hidden', true);
        label_imagen.setAttribute('hidden', true);
        input_imagen.setAttribute('hidden', true);
        document.getElementById('nombre').setAttribute('value', nombre);


    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}
