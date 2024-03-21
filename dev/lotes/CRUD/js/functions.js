window.onload = () => {
    getDominantImageColor = ()=>{
        let sourceImage = document.getElementById('imagen_lote');
        let background = document.querySelector(".form-info");
        let colorThief = new ColorThief();
        let color = colorThief.getColor(sourceImage);
        background.style.backgroundColor = "rgb(" + color + ")";
    }
    getDominantImageColor();
    }

function eliminarLote() {
    var respuesta = confirm("¿Eliminar Lote?, La información del lote no volverá a ser usada ¿continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}

function editarLote() {
    var respuesta = confirm("¿Editar Lote?, Puede alterar registros y estadisticas importantes ¿continuar?");
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
        const inputs = formulario.querySelectorAll('input[type="text"]');
        const btn_crear = document.getElementById('btn-crear');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_edit = document.getElementById('btn-edit');
        const btn_delete = document.getElementById('btn-delete');
        const btn_cancel = document.getElementById('btn-cancel');
        
        inputs.forEach(input => {
            input.removeAttribute('readonly');
        });
        btn_crear.setAttribute('hidden', true);
        btn_guardar.removeAttribute('hidden');
        btn_edit.setAttribute('hidden', true);
        btn_delete.setAttribute('hidden', true);
        btn_cancel.removeAttribute('hidden');
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
        
        inputs.forEach(input => {
            input.setAttribute('readonly', true);
        });
        btn_crear.removeAttribute('hidden');
        btn_guardar.setAttribute('hidden', true);
        btn_edit.removeAttribute('hidden');
        btn_delete.removeAttribute('hidden');
        btn_cancel.setAttribute('hidden', true);
    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}


